<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Miasto;

class MiastaController extends Controller
{
     public function getAllCities(){
    	$produkty = Miasto::all();

    	return $produkty;
	}
}
