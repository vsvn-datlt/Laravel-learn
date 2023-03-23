<?php

namespace App\Repositories;

class CompanyRepository
{
    public function pluck()
    {
        $companies = $this->getCompanies();
        return $companies;
    }

    protected function getCompanies()
    {
        return [
            1 => ["name" => "Company One", "contacts" => 3409647897],
            2 => ["name" => "Company Two", "contacts" => 8765679960],
            3 => ["name" => "Company Three", "contacts" => 8747964336]
        ];
    }
}
