<?php

declare(strict_types=1);

namespace EvolutionSDK\HttpClient;

use Dotenv\Dotenv;
use EvolutionSDK\Singleton;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class API extends Singleton
{
    private string $base_url;
    private array $headers;
    private string $token;

    protected function __construct()
    {
        Dotenv::createUnsafeImmutable('./')->load();
        $this->base_url = getenv('EVOLUTION_URL');
        $this->token = getenv('EVOLUTION_TOKEN');

        $this->headers = [
            'Content-Type' => 'application/json',
            'apiKey' => $this->token,
        ];
    }

    /**
     * @throws GuzzleException
     */
    public function call(string $method, string $uri, array $data = []): Response
    {
        $endpoint = $this->base_url.$uri;

        $client = new Client([
            'base_uri' => $this->base_url,
            'verify' => false,
            'http_errors' => false
        ]);

        $options = [
            'headers' => $this->headers,
            'Content-Type' => 'application/json'
        ];

        $options = array_merge($options, $data);

        $response = new Response($client->request($method, $uri, $options));

        if ($response->failed()) {
            $this->log($endpoint, $data, $response);
        }

        return $response;
    }

    /**
     * @throws GuzzleException
     */
    public function post(string $uri, array $data = []): Response
    {
        return $this->call('POST', $uri, ['body' => json_encode($data)]);
    }

    /**
     * @throws GuzzleException
     */
    public function get(string $uri, array $data = []): Response
    {
        return $this->call('GET', $uri, $data);
    }

    /**
     * @throws GuzzleException
     */
    public function put(string $uri, array $data = []): Response
    {
        return $this->call('PUT', $uri, ['body' => json_encode($data)]);
    }

    /**
     * @throws GuzzleException
     */
    public function delete(string $uri, array $data = []): Response
    {
        return $this->call('DELETE', $uri, ['body' => json_encode($data)]);
    }

    public function log(string $endpoint, array $data, Response $response): void
    {
        error_log(json_encode([
            'evolution-api-error' => [
                'endpoint' => $endpoint,
                'data' => $data,
                'response' => $response->body(),
                'error-code' => $response->status()
            ]
        ]));
    }
}