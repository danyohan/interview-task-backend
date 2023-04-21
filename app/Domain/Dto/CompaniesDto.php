<?php

namespace App\Domain\Dto;

use App\Domain\Models\Company;

class CompaniesDto
{

    public $name;
    public $street;
    public $city;
    public $zip;
    public $phone;

    public function __construct(Company $company) {
      
        $this->name    = $company->name;
        $this->street  = $company->street;
        $this->city    = $company->city;
        $this->zip     = $company->zip;
        $this->phone   = $company->phone;

    }

}