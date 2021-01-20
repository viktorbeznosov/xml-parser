<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientNumber extends Model
{

    protected $table = 'client_numbers';
    protected $fillable = array('client_id', 'number');

}
