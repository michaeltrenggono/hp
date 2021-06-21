<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1,5) as $index) {
            DB::table('customers')->insert([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->email,
                'phone' => $faker->numerify('04########'),
                'created_at' => $faker->dateTimeThisYear,
            ]);
        }

        $customerIds = DB::table('customers')->pluck('id');

        foreach (range(1,10) as $index) {
            DB::table('leads')->insert([
                'customer_id' => $faker->randomElement($customerIds),
                'suburb' => $faker->randomElements(["Melbourne 3000", "St Kilda 3182", "Box Hill 3128"])[0],
                'category' => $faker->randomElements(["Painters", "Interior Painters", "Home Renovations", "General Building Work"])[0],
                'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'price' => $faker->numberBetween(20, 300),
                'status' => $faker->randomElements(["Invited", "Accepted", "Declined"])[0],
                'created_at' => $faker->dateTimeThisYear,
            ]);
        }
    }
}
