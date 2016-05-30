<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produkt extends Model
{
     protected $table = 'produkty';

     public function miasto()
    {
    	return $this->belongsTo('App\Miasto');
    }
}


