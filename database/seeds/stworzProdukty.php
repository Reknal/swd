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
    }
}
