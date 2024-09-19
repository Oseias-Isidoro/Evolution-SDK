<?php

namespace EvolutionSDK\Interfaces;

use EvolutionSDK\HttpClient\API;
use EvolutionSDK\Instances\Instance;

interface InstanceInterface
{
    public function __construct(API $api);

    public function create(
        string $name,
        string $token,
        string $webhook,
        array $events = [],
        bool $qrcode = true,
        bool $webhookByEvents = false,
        array $customFields = []
    ): Instance;

    public function connectionState(string $instanceName): object;

    public function connect(string $instanceName): object;

    public function delete(string $instanceName): object;

    public function logout(string $instanceName): object;
}