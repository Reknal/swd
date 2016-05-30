<?php

use Illuminate\Database\Seeder;

class stworzProdukty extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('produkty')->insert([
                        'nazwa' => "Telewizor", 
                        'objetosc' => 50,
                        'masa' => 8,
                        'wartosc' => 400,
                        'liczbaProduktow' => 2,
                        'miastoId' => 474
             ]);

         DB::table('produkty')->insert([
                        'nazwa' => "Komputer", 
                        'objetosc' => 50,
                        'masa' => 3,
                        'wartosc' => 850,
                        'liczbaProduktow' => 5,
                        'miastoId' => 136
             ]);

         DB::table('produkty')->insert([
                        'nazwa' => "Stolik", 
                        'objetosc' => 80,
                        'masa' => 10,
                        'wartosc' => 80,
               			'liczbaProduktow' => 1,
                        'miastoId' => 403
             ]);

         DB::table('produkty')->insert([
                        'nazwa' => "Wierza stereo", 
                        'objetosc' => 20,
                        'masa' => 7,
                        'wartosc' => 350,
                        'liczbaProduktow' => 2,
                        'miastoId' => 474
             ]);

         DB::table('produkty')->insert([
                        'nazwa' => "Wiertarka", 
                        'objetosc' => 5,
                        'masa' => 2,
                        'wartosc' => 100,
                        'liczbaProduktow' => 5,
                        'miastoId' => 136
             ]);

        DB::table('produkty')->insert([
                        'nazwa' => "Krzesło", 
                        'objetosc' => 30,
                        'masa' => 3,
                        'wartosc' => 20,
                        'liczbaProduktow' => 4,
                        'miastoId' => 403
             ]);


         DB::table('produkty')->insert([
                        'nazwa' => "Fotel", 
                        'objetosc' => 70,
                        'masa' => 15,
                        'wartosc' => 80,
                        'liczbaProduktow' => 1,
                        'miastoId' => 474
             ]);

          DB::table('produkty')->insert([
                        'nazwa' => "Łóżko", 
                        'objetosc' => 280,
                        'masa' => 90,
                        'wartosc' => 200,
                        'liczbaProduktow' => 1,
                        'miastoId' => 136
             ]);

         DB::table('produkty')->insert([
                        'nazwa' => "Kanapa", 
                        'objetosc' => 300,
                        'masa' => 120,
                        'wartosc' => 350,
                        'liczbaProduktow' => 2,
                        'miastoId' => 403
             ]);


         DB::table('produkty')->insert([
                        'nazwa' => "Piła motorowa", 
                        'objetosc' => 40,
                        'masa' => 9,
                        'wartosc' => 300,
                        'liczbaProduktow' => 1,
                        'miastoId' => 474
             ]);

         DB::table('produkty')->insert([
                        'nazwa' => "Kosiarka spalinowa", 
                        'objetosc' => 150,
                        'masa' => 70,
                        'wartosc' => 370,
                        'liczbaProduktow' => 3,
                        'miastoId' => 474
             ]);


          DB::table('produkty')->insert([
                        'nazwa' => "Wykaszarka", 
                        'objetosc' => 80,
                        'masa' => 9,
                        'wartosc' => 200,
                        'liczbaProduktow' => 2,
                        'miastoId' => 474
             ]);
    }
}
