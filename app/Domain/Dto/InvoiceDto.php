<?php

namespace App\Domain\Dto;

class InvoiceDTO
{

    private $number;
    private $date;
    private $dueDate;
    private $company;

    public function __construct($number, $date, $dueDate, CompanyDto $company) {
      
        $this->number   = $number;
        $this->date     = $date;
        $this->dueDate  = $dueDate;
        $this->company  = $company;

    }

}