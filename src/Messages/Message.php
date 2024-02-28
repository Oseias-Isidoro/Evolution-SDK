<?php

declare(strict_types=1);

namespace EvolutionSDK\Messages;

class Message
{
    private array $data;
    private string $instance;

    public function __construct(array $data, string $instance)
    {
        $this->data = $data;
        $this->instance = $instance;
    }

    public function getInstance(): string
    {
        return $this->instance;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function hasMedia(): bool
    {
        return isset($this->data['mediaMessage']);
    }

    public function hasAudio(): bool
    {
        return isset($this->data['audioMessage']);
    }
}