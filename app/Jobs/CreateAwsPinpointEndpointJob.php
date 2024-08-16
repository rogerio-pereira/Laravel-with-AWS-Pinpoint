<?php

namespace App\Jobs;

use App\Models\User;
use App\Services\PinpointService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CreateAwsPinpointEndpointJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected User $user,
        protected PinpointService $pinpointService
    ) { }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->pinpointService
            ->createEndpoint(
                $this->user->id, 
                $this->user->email, 
                $this->user->toArray()
            );
    }
}
