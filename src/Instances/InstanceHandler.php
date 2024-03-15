<?php

namespace EvolutionSDK\Instances;

use EvolutionSDK\HttpClient\API;
use EvolutionSDK\Transformers\APIInstanceResponse\APIInstanceResponseTransformer;
use Exception;
use GuzzleHttp\Exception\GuzzleException;

class InstanceHandler
{
    private API $API;

    public function __construct(string $base_url = null, string $token = null)
    {
        $this->API = new API($base_url, $token);
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function create(
        string $name,
        string $token,
        string $webhook,
        array $events = [],
        bool $qrcode = true,
        bool $webhookByEvents = false,
        array $customFields = []
    ): Instance {

        $payload = [
            'instanceName' => $name,
            'token' => $token,
            'qrcode' => $qrcode,
            'events' => $events,
            'webhookByEvents' => $webhookByEvents,
            'webhook' => $webhook,
        ];

        $payload = array_merge($payload, $customFields);

        $response = $this->API->post('/instance/create', $payload);

        if ($response->failed()) {
            throw new Exception($response->body(), $response->status());
        }

        return (new APIInstanceResponseTransformer($response))
            ->toInstanceObject();
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function connectionState(string $instanceName)
    {
        $response = $this->API->get('/instance/connectionState/'.$instanceName);

        if ($response->failed()) {
            throw new Exception($response->body(), $response->status());
        }

        return $response->object();
    }
}