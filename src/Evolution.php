<?php

namespace EvolutionSDK;

use EvolutionSDK\HttpClient\API;
use EvolutionSDK\Instances\v1\InstanceHandler;
use EvolutionSDK\Interfaces\InstanceInterface;
use EvolutionSDK\Interfaces\MessageBuilderInterface;
use EvolutionSDK\Messages\Messenger;
use EvolutionSDK\Messages\v1\MessageBuilder;
use Exception;

class Evolution
{
    private string $base_url;
    private string $token;
    private API $api;

    private string $version = 'v0.4.12';

    public const VERSION_0_4_12 = 'v0.4.12';
    public const VERSION_2_0_0 = 'v2.0.0';

    public function __construct(string $base_url = null, string $token = null, string $version = 'v0.4.12')
    {
        $this->api = new API($base_url, $token);
        $this->base_url = $base_url;
        $this->token = $token;
        $this->version = $version;
    }

    /**
     * @throws Exception
     */
    public function instance(): InstanceInterface
    {
        switch ($this->version) {
            case self::VERSION_0_4_12:
                return new InstanceHandler($this->api);
            case self::VERSION_2_0_0:
                return new \EvolutionSDK\Instances\v2\InstanceHandler($this->api);
        }

        throw new Exception("version {$this->version} not supported");
    }

    public function messenger(): Messenger
    {
        return new Messenger($this->api);
    }

    /**
     * @throws Exception
     */
    public function messageBuilder(): MessageBuilderInterface
    {
        switch ($this->version) {
            case 'v0.4.12':
                return new MessageBuilder();
            case 'v2.0.0':
                return new \EvolutionSDK\Messages\v2\MessageBuilder();
        }

        throw new Exception("version {$this->version} not supported");
    }
}