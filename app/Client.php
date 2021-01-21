<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = array('client_id', 'name', 'city', 'age');

    public function phone_numbers(){
  		return $this->hasMany('App\ClientNumber');
  	}

    public function phone_numbers_shirt(){
      $phone_numbers = $this->phone_numbers()->get();

      if (count($phone_numbers) > 0){
        return $phone_numbers[0]->number . '...';
      }

      return false;
    }

    public static function clientsSort($type = false){
      switch ($type) {
        case 'nameAsc':
            $clients = Client::all()->sortBy('name');
            break;
        case 'nameDesc':
            $clients = Client::all()->sortByDesc('name');
            break;
        case 'ageAsc':
            $clients = Client::all()->sortBy('age');
            break;
        case 'ageDesc':
            $clients = Client::all()->sortByDesc('age');
            break;
        case 'cityAsc':
            $clients = Client::all()->sortBy('city');
            break;
        case 'cityDesc':
            $clients = Client::all()->sortByDesc('city');
            break;
        default:
          $clients = Client::all();
          break;
        }

        return $clients;
    }
}
