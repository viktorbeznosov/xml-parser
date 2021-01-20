<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = array('client_id', 'name', 'city', 'age');

    public function phone_numbers(){
		return $this->hasMany('App\ClientNumber');
	}
}
