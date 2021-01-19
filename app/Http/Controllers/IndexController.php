<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Orchestra\Parser\Xml\Facade as XmlParser;

class IndexController extends Controller
{
    public function show(){
        die(__METHOD__);

        return view('index');
    }

    public function parse(){
        $path = base_path();
        $clients_xml_file = $path . '/clients.xml';


        $content = file_get_contents($clients_xml_file);
        $xml = new \SimpleXMLElement($content);

        dump($xml);
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
            $attributesArr = (array) $client->attributes();
            $id = $attributesArr['@attributes']['id']; //id объекта

            $data = array(
                'id' => $id,
                'name' => $name,
                'city' => $city,
                'membership_date' => $membership_date,
                'age' => $age,
                'numbers' => $numbers['number']
            );

            dump($data);
        }
    }
}
