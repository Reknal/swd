<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Produkt;

class ProduktyController extends Controller
{
     public function getAllProducts(){
    	$produkty = Produkt::all();

    	return $produkty;
    }
}
