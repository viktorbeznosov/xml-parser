<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Orchestra\Parser\Xml\Facade as XmlParser;
use App\Client;
use App\ClientNumber;

class IndexController extends Controller
{
    public function show(){
        die(__METHOD__);

        return view('index');
    }

    public function parse(){
        $path = base_path();
        $clients_xml_file = $path . '/clients.xml';
        echo "---------------------- Starting parser ----------------------<br>";

        $client_ids = array();
        if (is_file($clients_xml_file)){
            $content = file_get_contents($clients_xml_file);
            $xml = new \SimpleXMLElement($content);

            if (count($xml->client) > 0){
                echo "Found - " . count($xml->client) . " clients<br>";
                foreach ($xml->client as $client){
                    $name = (array) $client->name;
                    $name = $name[0]; //Имя
                    $city = (array) $client->city;
                    $city = $city[0]; //город
                    $membership_date = (array) $client->membership_date;
                    $membership_date = $membership_date[0]; //Дата создания
                    $age = (array) $client->age;
                    $age = $age[0];//возраст
                    $numbers = (array) $client->numbers;
                    $numbers = (isset($numbers['number'])) ? (array) $numbers['number'] : array();
                    $attributesArr = (array) $client->attributes();
                    $client_id = $attributesArr['@attributes']['id']; //id объекта
                    $client_ids[] = $client_id;

                    $data = array(
                        'client_id' => $client_id,
                        'name' => $name,
                        'city' => $city,
                        'created_at' => $membership_date,
                        'age' => $age,
                    );

                    $client = Client::where('client_id', $client_id)->get();
                    if (count($client) == 0){
                        $client = new Client();
                        $client->fill($data);
                        $client->save();
                        //телефонные номера
                        if (count($numbers) > 0){
                            foreach ($numbers as $number){
                                $clientNumber = new ClientNumber();
                                $clientNumber->number = $number;
                                $clientNumber->client_id = $client->id;
                                $clientNumber->save();
                            }
                        }
                        echo "Add new client " . $client->name . ", age " . $client->age . ", city " . $client->city . "<br>";

                    } else {
                        $client = $client[0];
                        if (count($numbers) > 0){
                            foreach ($numbers as $number){
                                $clientNumber = ClientNumber::where('client_id',$client->id)->where('number', $number)->get();
                                if (count($clientNumber) == 0){
                                    $clientNumber = new ClientNumber();
                                    $clientNumber->number = $number;
                                    $clientNumber->client_id = $client->id;
                                    $clientNumber->save();
                                    echo "Client " . $client->name . " Add number " . $clientNumber->number . "<br>";
                                }
                            }
                        }

                        foreach ($client->phone_numbers()->get() as $item){
                            if (!in_array($item->number, $numbers)){
                                echo "Client " . $client->name . " number " . $item->number . " deleted<br>";
                                $item->delete();
                            }
                        }

                        if ($city != $client->city || $age != $client->age){
                            $client->fill(array(
                                'city' =>  $city,
                                'age' => $age
                            ));
                            $client->save();
                            echo "Client " . $client->name . " updated<br>";
                        }
                    }

                }
            }

            $clients = Client::all();
            foreach ($clients as $item){
                if(!in_array($item->client_id, $client_ids)){
                    echo "Client " . $item->name . " deleted <br>";
                    $item->phone_numbers()->delete();
                    $item->delete();
                }
            }
        }


    }
}
