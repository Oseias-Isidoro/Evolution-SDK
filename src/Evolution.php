<?php

namespace EvolutionSDK;

use EvolutionSDK\Instances\InstanceHandler;
use EvolutionSDK\Messages\Messenger;

class Evolution
{
    private string $base_url;
    private string $token;

    public function __construct(string $base_url = null, string $token = null)
    {
        $this->base_url = $base_url;
        $this->token = $token;
    }

    public function instance(): InstanceHandler
    {
        return new InstanceHandler($this->base_url, $this->token);
    }

    public function messenger(): Messenger
    {
        return new Messenger($this->base_url, $this->token);
    }
}