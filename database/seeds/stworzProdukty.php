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
                        'nazwa' => "Telewizor", // chirurg
                        'objetosc' => 50,
                        'masa' => 8,
                        'wartosc' => 400,
                        'liczbaProduktow' => 2,
             ]);

         DB::table('produkty')->insert([
                        'nazwa' => "Komputer", // chirurg
                        'objetosc' => 50,
                        'masa' => 3,
                        'wartosc' => 850,
                        'liczbaProduktow' => 5,

             ]);

         DB::table('produkty')->insert([
                        'nazwa' => "Stolik", // chirurg
                        'objetosc' => 80,
                        'masa' => 10,
                        'wartosc' => 80,
               			'liczbaProduktow' => 1,
             ]);

         DB::table('produkty')->insert([
                        'nazwa' => "Wierza stereo", // chirurg
                        'objetosc' => 20,
                        'masa' => 7,
                        'wartosc' => 350,
                        'liczbaProduktow' => 2,
             ]);

         DB::table('produkty')->insert([
                        'nazwa' => "Wiertarka", // chirurg
                        'objetosc' => 5,
                        'masa' => 2,
                        'wartosc' => 100,
                        'liczbaProduktow' => 5,
             ]);

        DB::table('produkty')->insert([
                        'nazwa' => "Krzesło", // chirurg
                        'objetosc' => 30,
                        'masa' => 3,
                        'wartosc' => 20,
                        'liczbaProduktow' => 4,
             ]);


         DB::table('produkty')->insert([
                        'nazwa' => "Fotel", // chirurg
                        'objetosc' => 70,
                        'masa' => 15,
                        'wartosc' => 80,
                        'liczbaProduktow' => 1,
             ]);

          DB::table('produkty')->insert([
                        'nazwa' => "Łóżko", // chirurg
                        'objetosc' => 280,
                        'masa' => 90,
                        'wartosc' => 200,
                        'liczbaProduktow' => 1,
             ]);

         DB::table('produkty')->insert([
                        'nazwa' => "Kanapa", // chirurg
                        'objetosc' => 300,
                        'masa' => 120,
                        'wartosc' => 350,
                        'liczbaProduktow' => 2,
             ]);


         DB::table('produkty')->insert([
                        'nazwa' => "Piła motorowa", // chirurg
                        'objetosc' => 40,
                        'masa' => 9,
                        'wartosc' => 300,
                        'liczbaProduktow' => 1,
             ]);

         DB::table('produkty')->insert([
                        'nazwa' => "Kosiarka spalinowa", // chirurg
                        'objetosc' => 150,
                        'masa' => 70,
                        'wartosc' => 370,
                        'liczbaProduktow' => 3,
             ]);


          DB::table('produkty')->insert([
                        'nazwa' => "Wykaszarka", // chirurg
                        'objetosc' => 80,
                        'masa' => 9,
                        'wartosc' => 200,
                        'liczbaProduktow' => 2,
             ]);
    }
}
