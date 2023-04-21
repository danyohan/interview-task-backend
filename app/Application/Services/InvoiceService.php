<?php

namespace App\Application\Services;

use App\Domain\Dto\BilledCompanyDto;
use App\Domain\Dto\CompaniesDto;
use App\Domain\Dto\InvoiceDTO;
use App\Domain\Dto\ProductsDto;
use App\Domain\Repository\InvoiceRepository;
use App\Modules\Approval\Api\ApprovalFacadeInterface;
use App\Modules\Approval\Application\ApprovalFacade;

class InvoiceService
{
    protected $invoiceRepository;
    protected $facade;

    public function __construct(InvoiceRepository $invoiceRepository, ApprovalFacade $facade)
    {
        $this->invoiceRepository = $invoiceRepository;
        $this->facade = $facade;
    }

    public function getInvoices(string $id)
    {
        $invoices  = $this->invoiceRepository->getInvoices($id);

        $companies = $this->invoiceRepository->getCompanies($invoices->company_id);

        $products = $this->invoiceRepository->getproducts($id);
        return new InvoiceDTO(
            $invoices->number,
            $invoices->date,
            $invoices->due_date,
            new CompaniesDto($companies),
            new BilledCompanyDto($companies),
            new ProductsDto($products)
        );
    }

    public function approve($entity)
    {
        return $this->facade->approve($entity);
    }

    public function reject($entity)
    {
        $this->facade->reject($entity);
    }
}
