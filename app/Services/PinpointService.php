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

    /**
     * Create an endpoint in pinpoint
     *      In AWS Pinpoint, an endpoint represents a destination where messages are delivered. An endpoint typically 
     *      corresponds to a specific communication channel tied to a user. For example, an endpoint could be an 
     *      email address, a phone number, or a device ID for push notifications. (ChatGPT)
     *
     * @param integer $endpointId
     * @param string $email
     * @param array $attributes
     * @return void
     */
    public function createEndpoint(int $endpointId, string $email, array $attributes = [])
    {
        $appId = config('services.pinpoint.app_id');

        return $this->pinpoint->updateEndpoint([
                        'ApplicationId' => $appId,
                        'EndpointId'    => $endpointId,
                        'EndpointRequest' => [
                            'Address' => $email,
                            'ChannelType' => 'EMAIL',
                            'Attributes' => $attributes, // Optional custom attributes
                            'User' => [
                                'UserId' => $endpointId, // Use the endpoint ID as the user ID
                                'UserAttributes' => [
                                    'name' => [$attributes['name']],
                                    'email' => [$attributes['email']],
                                ],
                            ],
                        ],
                    ]);
    }
}
