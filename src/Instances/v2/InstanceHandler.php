<?php

namespace EvolutionSDK\Instances\v2;

use EvolutionSDK\HttpClient\API;
use EvolutionSDK\Instances\Instance;
use EvolutionSDK\Interfaces\InstanceInterface;
use EvolutionSDK\Transformers\APIInstanceResponse\APIInstanceResponseTransformer;
use Exception;
use GuzzleHttp\Exception\GuzzleException;

class InstanceHandler implements InstanceInterface
{
    private API $API;


    public function __construct(API $api)
    {
        $this->API = $api;
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
            'webhookByEvents' => $webhookByEvents,
            'webhook' => [
                'url' => $webhook,
                'events' => $events,
            ],
        ];

        $payload = array_merge($payload, $customFields);

        error_log(json_encode($payload));

        $response = $this->API->post('/instance/create', $payload);

        error_log($response->body());

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
    public function connectionState(string $instanceName): object
    {
        $response = $this->API->get('/instance/connectionState/'.$instanceName);

        if ($response->failed()) {
            throw new Exception($response->body(), $response->status());
        }

        return $response->object();
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function connect(string $instanceName): object
    {
        $response = $this->API->get('/instance/connect/'.$instanceName);

        if ($response->failed()) {
            throw new Exception($response->body(), $response->status());
        }

        return $response->object();
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function delete(string $instanceName): object
    {
        $response = $this->API->delete('/instance/delete/'.$instanceName);

        if ($response->failed()) {
            throw new Exception($response->body(), $response->status());
        }

        return $response->object();
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function logout(string $instanceName): object
    {
        $response = $this->API->delete('/instance/logout/'.$instanceName);

        if ($response->failed()) {
            throw new Exception($response->body(), $response->status());
        }

        return $response->object();
    }
}