<?php

namespace App\Listeners;

use App\Events\PurchaseEvent;
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
        Log::info('Event Purchase', $event->purchase->toArray());
    }
}
