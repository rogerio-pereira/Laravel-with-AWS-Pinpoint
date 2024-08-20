<?php

namespace App\Listeners;

use App\Events\PurchaseEvent;
use App\Jobs\CreateAwsPinpointEventJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class PurchaseListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PurchaseEvent $event): void
    {
        $purchase = $event->purchase;
        $purchase->load('product');

        CreateAwsPinpointEventJob::dispatch($purchase);
    }
}
