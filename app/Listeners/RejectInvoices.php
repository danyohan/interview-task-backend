<?php

namespace App\Listeners;

use App\Domain\Repository\InvoiceRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RejectInvoices
{

    protected $invoiceRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(InvoiceRepository $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $this->invoiceRepository->rejectInvoice($event->approvalDto);
    }
}
