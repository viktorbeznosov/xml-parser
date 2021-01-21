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
}
