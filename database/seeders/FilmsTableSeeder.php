<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FilmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table= \DB::table('films');
        $faker = Faker::create();
        for ($i=0; $i < 10 ; $i++) { 
            $insert['title'] = $faker->firstname;
            $insert['synopsis'] = $faker->lastname;
            $insert['age'] = rand ( 10 , getrandmax());
            $table->insert($insert);
        }
    }
}
