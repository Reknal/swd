<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Produkt;
use App\Miasto;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Validator;


class ProduktyController extends Controller
{
     public function getAllProducts(){
    	$produkty = DB::table('produkty')
        ->join('miasta', 'produkty.miastoId', '=', 'miasta.id')->get();

    	return $produkty;
    }

    public function addProduct(){
    	$miasta = Miasto::lists('miasto', 'id');

    	// return $miasta;

        return response()->view('addProduct', compact('miasta'));
    }

    public function addProductToDatabase(){

    	$validator = Validator::make(Input::all(),		    
		    array(
		        'nazwa' => 'required|min:3|max:70',
		        'miasto' => 'required',
		       	'masa' => 'required',
		       	'objetosc' => 'required',
		       	'wartosc' => 'required',
		       	'lsztuk' => 'required',
		    )
		);

		if($validator->fails()){
			return redirect()->back()->withErrors($validator);		
		}		


    	$nazwa = input::get('nazwa');
    	$miasto = input::get('miasto');
    	$masa = input::get('masa');
    	$objetosc = input::get('objetosc');
    	$wartosc = input::get('wartosc');
    	$lsztuk = input::get('lsztuk');

    	$product = new Produkt;
    	$product->nazwa = $nazwa;
    	$product->miastoId = $miasto;
    	$product->objetosc = $objetosc;
    	$product->masa = $masa;
    	$product->wartosc = $wartosc;
    	$product->liczbaProduktow = $lsztuk;

    	$product->save();

		return redirect()->back()->with('correctAddProduct', 'Produkt został dodany poprawnie');  
 	}
}
