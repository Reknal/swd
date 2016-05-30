<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Produkt;
use DB;

class ProduktyController extends Controller
{
     public function getAllProducts(){
    	$produkty = DB::table('produkty')
        ->join('miasta', 'produkty.miastoId', '=', 'miasta.id')->get();

    	return $produkty;
    }
}
