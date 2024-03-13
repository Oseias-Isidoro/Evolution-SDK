<?php

namespace EvolutionSDK\Instances;

use EvolutionSDK\HttpClient\API;
use EvolutionSDK\Transformers\APIInstanceResponse\APIInstanceResponseTransformer;
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
     * @throws \Exception
     */
    public function create(
        string $name,
        string $token,
        string $webhook,
        array $events = [],
        bool $qrcode = true,
        bool $webhookByEvents = false
    ): Instance {
        $response = $this->API->post('/instance/create', [
            'instanceName' => $name,
            'token' => $token,
            'qrcode' => $qrcode,
            'events' => $events,
            'webhookByEvents' => $webhookByEvents,
            'webhook' => $webhook,
        ]);

        if ($response->failed()) {
            throw new \Exception($response->body(), $response->status());
        }

        return (new APIInstanceResponseTransformer($response))
            ->toInstanceObject();
    }
}