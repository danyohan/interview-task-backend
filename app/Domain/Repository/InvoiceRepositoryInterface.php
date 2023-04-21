<?php

namespace App\Domain\Repository;

interface InvoiceRepositoryInterface
{
    public function getInvoices($id);
}