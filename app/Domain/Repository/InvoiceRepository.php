<?php

namespace App\Domain\Repository;

use App\Domain\Models\Invoice;
use App\Domain\Models\Company;
use App\Domain\Models\Product;
use Illuminate\Support\Facades\DB;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function getInvoices($id)
    {
        return Invoice::findOrFail($id);
    }

    public function getCompanies($id)
    {
        return Company::find($id);
    }

    public function getproducts(string $id)
    {

        return Product::join('invoice_product_lines', 'products.id',  'invoice_product_lines.product_id')
            ->select('products.NAME as name', 'products.price', 'invoice_product_lines.quantity', 
                    DB::raw('products.price * invoice_product_lines.quantity AS total'))
            ->where('invoice_product_lines.invoice_id', '=',  $id)
            ->get();
    }


    public  function approveInvoice($data)
    {
        Invoice::where('id', $data->id->toString())
                 ->where('status', '!=', 'rejected')
                 ->update(['status' => 'approved']);
    }

    public  function rejectInvoice($data)
    {
        Invoice::where('id', $data->id->toString())
                ->where('status', '!=', 'approved')
                ->update(['status' => 'rejected']);
    }
}
