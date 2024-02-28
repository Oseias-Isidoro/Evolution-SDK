<?php

declare(strict_types=1);

namespace EvolutionSDK\HttpClient;

use Psr\Http\Message\ResponseInterface;

class Response
{
    protected ResponseInterface $response;
    private int $http_code;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
        $this->http_code = $response->getStatusCode();
    }

    public function body(): string
    {
        return (string) $this->response->getBody();
    }

    public function successful(): bool
    {
        return ($this->http_code >= 200 and $this->http_code <= 299);
    }

    public function array()
    {
        return json_decode($this->body(), true);
    }

    public function object()
    {
        return json_decode($this->body());
    }

    public function clientError(): bool
    {
        return ($this->http_code >= 400 and $this->http_code <= 499);
    }

    public function serverError(): bool
    {
        return ($this->http_code >= 500 and $this->http_code <= 599);
    }

    public function failed(): bool
    {
        return !$this->successful();
    }

    public function status(): int
    {
        return $this->http_code;
    }
}