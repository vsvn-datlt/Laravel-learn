<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

use App\Models\Company as Company;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companyIds = Company::pluck('id')->toArray();
        $faker = Faker::create();
        $companies = [];
        foreach (range(1, 1000) as $index) {
            $company = [
                "first_name" => $faker->firstName(),
                "last_name" => $faker->lastName(),
                "phone" => $faker->phoneNumber(),
                "email" => $faker->email(),
                "address" => $faker->address(),
                'company_id' => $companyIds[array_rand($companyIds)],
                "created_at" => now(),
                "updated_at" => now(),
            ];
            $companies[] = $company;
        }

        DB::table("contacts")->delete();
        DB::table("contacts")->insert($companies);
    }
}
