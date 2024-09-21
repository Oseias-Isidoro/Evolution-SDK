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

    public function hasContact(): bool
    {
        return isset($this->data['contactMessage']) OR isset($this->data['contact']);
    }

    public function hasSticker(): bool
    {
        return isset($this->data['stickerMessage']) OR isset($this->data['sticker']);
    }

    public function hasLocation(): bool
    {
        return isset($this->data['locationMessage']) OR (isset($this->data['latitude']) AND isset($this->data['longitude']));
    }

    public function hasMedia(): bool
    {
        return isset($this->data['mediaMessage']) OR isset($this->data['media']);
    }

    public function hasAudio(): bool
    {
        return isset($this->data['audioMessage']) OR isset($this->data['audio']);
    }

    public function hasTemplate(): bool
    {
        return isset($this->data['components']);
    }
}