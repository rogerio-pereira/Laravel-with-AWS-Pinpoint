<?php

namespace App\Jobs;

use App\Models\Purchase;
use App\Services\PinpointService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CreateAwsPinpointEventJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected Purchase $purchase
    ) { }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $service = new PinpointService;

        $service
            ->createEvent(
                $this->purchase->id, 
                $this->purchase->user_id, 
                'Purchase', 
                [
                    'ProductID' => $this->purchase->product->id,
                    'ProductName' => $this->purchase->product->name,
                    'ProductPrice' => $this->purchase->product->price,
                ]
            );
    }
}
