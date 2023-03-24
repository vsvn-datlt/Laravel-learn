<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $companies = [];
        foreach (range(1, 100) as $index) {
            $company = [
                "name" => $faker->company(),
                "address" => $faker->address(),
                "website" => "https://" . $faker->domainName(),
                "email" => $faker->email(),
                "created_at" => now(),
                "updated_at" => now(),
            ];
            $companies[] = $company;
        }

        DB::table("companies")->delete();
        DB::table("companies")->insert($companies);
    }
}
