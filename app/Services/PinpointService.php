<?php

namespace App\Services;

use Aws\Pinpoint\PinpointClient;

class PinpointService
{
    protected $pinpoint;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->pinpoint = new PinpointClient([
            'version' => 'latest',
            'region'  => config('services.pinpoint.region'),
            'credentials' => [
                'key'    => config('services.pinpoint.key'),
                'secret' => config('services.pinpoint.secret'),
            ],
        ]);
    }
}
