<?php

namespace App\Services;

use Aws\Pinpoint\PinpointClient;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PinpointService
{
    protected $pinpoint;
    protected $appId;

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

        $this->appId = config('services.pinpoint.app_id');
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
        try{
            $endpoint = $this->pinpoint->updateEndpoint([
                                'ApplicationId' => $this->appId,
                                'EndpointId'    => $endpointId,
                                'EndpointRequest' => [
                                    'Address' => $email,
                                    'ChannelType' => 'EMAIL',
                                    // 'Attributes' => $attributes, // Optional custom attributes
                                    'Attributes' => [], // Optional custom attributes
                                    'User' => [
                                        'UserId' => $endpointId, // Use the endpoint ID as the user ID
                                        'UserAttributes' => [
                                            'name' => [$attributes['name']],
                                            'email' => [$attributes['email']],
                                        ],
                                    ],
                                ],
                            ]);

            Log::info("Pinpoint endpoint created. UserId: {$endpointId}, Email: {$email}");

            return $endpoint;
        }
        catch(\Exception $e) 
        {
            Log::error('Failed to create Pinpoint endpoint. Reason: '.$e->getMessage());
        }
    }

    /**
     * Create Event in Pinpoint
     *
     * @param integer $eventId
     * @param integer $endpointId
     * @param string $eventType
     * @param array $attributes
     * @param array $metrics
     * @return void
     */
    public function createEvent(int $eventId, int $endpointId, string $eventType, array $attributes = [], array $metrics = [])
    {
        try{
            $response = $this->pinpoint->putEvents([
                'ApplicationId' => $this->appId,
                'EventsRequest' => [
                    'BatchItem' => [
                        $endpointId => [
                            'Endpoint' => [],
                            'Events' => [
                                "event-{$eventId}" => [
                                    'EventType' => $eventType,
                                    'Timestamp' => now()->toIso8601String(),
                                    'Attributes' => $attributes,
                                    'Metrics' => $metrics,
                                ],
                            ],
                        ],
                    ],
                ],
            ]);

            $attributesJson = json_encode($attributes);
            Log::info("Pinpoint event created. Id: {$eventId}, endpointId: {$endpointId}, Event: {$eventType}, Attributes: {$attributesJson}");

            return $response;
        }
        catch(\Exception $e) 
        {
            Log::error('Failed to create Pinpoint endpoint. Reason: '.$e->getMessage());
        }
    }

    public function createMailTemplate(string $name, string $subject, string $html, string $text = null)
    {
        try{
            $this->pinpoint->createEmailTemplate([
                    'TemplateName' => Str::slug($name), //'string in kebab case' will be converted to 'string-in-kebab-case'
                    'EmailTemplateRequest' => [
                        'Subject' => $subject,
                        'HtmlPart' => $html,
                        'TextPart' => $text,
                    ],
                ]);

            Log::info("Pinpoint mail template created. Name: {$name}. Subject: {$subject}");
        }
        catch(\Exception $e) 
        {
            Log::error('Failed to create Pinpoint mail template. Reason: '.$e->getMessage());
            throw $e;
        }
    }
}
