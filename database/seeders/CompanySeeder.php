<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = [];
        foreach (range(1, 100) as $index) {
            $company = [
                "name" => $name = 'Company ' . substr(md5(mt_rand()), 0, 8),
                "address" => "Address " . strtolower($name),
                "website" => "https://" . str_replace(" ", "_", strtolower($name)) . "/home",
                "email" => "admin@" . str_replace(" ", "_", strtolower($name)) . ".com",
                "created_at" => now(),
                "updated_at" => now(),
            ];
            $companies[] = $company;
        }

        DB::table("companies")->delete();
        DB::table("companies")->insert($companies);
    }
}
