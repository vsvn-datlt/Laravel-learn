<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faker = Faker::create();
        // $companies = [];
        // foreach (range(1, 5) as $index) {
        //     $company = [
        //         "name" => $faker->company(),
        //         "address" => $faker->address(),
        //         "website" => "https://" . $faker->domainName(),
        //         "email" => $faker->email(),
        //         "created_at" => now(),
        //         "updated_at" => now(),
        //     ];
        //     $companies[] = $company;
        // }

        // DB::table("companies")->delete();
        // DB::table("companies")->insert($companies);

        Company::factory()->count(7)->create();
        // Company::factory(7)->hasContacts(145)->create();
    }
}
