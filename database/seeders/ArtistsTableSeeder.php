<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ArtistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Delete the table data   
        DB::table('artists')->delete();

        // Add a new entry to the table 
        DB::table('artists')->insert(
            [
                'name' => 'picazo',
                'balance' => 88,
                'volume_sold' => 0,
                'password' => Hash::make('1234'),
                'description' => 'Pedro picazo is the most popular NFT influencer in Hong Kong',
                'email' => 'picazo@gmail.com'
            ]
        );
        DB::table('artists')->insert(
            [
                'name' => 'vetoven',
                'balance' => 99,
                'volume_sold' => 500,
                'password' => Hash::make('1234'),
                'description' => 'Willy Vetoven is a new artist with high quality creations',
                'email' => 'vetoven@gmail.com'
            ]
        );
        DB::table('artists')->insert(
            [
                'name' => 'elbicho',
                'balance' => 111,
                'volume_sold' => 10,
                'password' => Hash::make('1234'),
                'description' => 'Jesus, also known as elbicho is a spanish influencer with a high amount of colaborations with some companies such as Zara, Adidas and Nike',
                'email' => 'elbicho@gmail.com'
            ]
        );
    }
}
