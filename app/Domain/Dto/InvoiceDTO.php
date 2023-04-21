<?php

namespace App\Domain\Dto;

class InvoiceDto
{

    private const TAX = 0.0625;

    public $number;
    public $date;
    public $dueDate;
    public $company;
    public $billedCompany;
    public $products;
    public $totalPrice;

    public function __construct($number, $date, $dueDate, CompaniesDto $company, BilledCompanyDto $billedCompany,  ProductsDto $products) {