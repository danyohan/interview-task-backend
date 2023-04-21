<?php

namespace App\Listeners;

use App\Domain\Repository\InvoiceRepository;
use App\Modules\Approval\Api\Events\EntityApproved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ApprovalInvoices
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
    public function handle(EntityApproved $event)
    {
        $this->invoiceRepository->approveInvoice($event->approvalDto);
    }
}
