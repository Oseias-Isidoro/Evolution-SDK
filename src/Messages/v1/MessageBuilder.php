<?php

declare(strict_types=1);

namespace EvolutionSDK\Messages\v1;

use EvolutionSDK\Interfaces\MessageBuilderInterface;
use EvolutionSDK\Messages\Message;

class MessageBuilder implements MessageBuilderInterface
{
    private array $message;
    private string $instance;

    public function __construct()
    {
        $this->message['options'] = [
            "delay" => 1200,
            "sendMessage" => false,
            "presence" => "composing"
        ];
    }

    public function from(string $instance): MessageBuilder
    {
        $this->instance = $instance;

        return $this;
    }

    public function to(string $number): MessageBuilder
    {
        $this->message['number'] = $number;

        return $this;
    }

    public function text(string $text): MessageBuilder
    {
        $this->message['textMessage'] = [
            'text' => $text
        ];

        return $this;
    }

    public function media(string $url, string $mediaType, string $fileName = null): MessageBuilder
    {
        $this->message['mediaMessage'] = [
            'mediatype' => $mediaType,
            'media' => $url,
        ];

        if ($fileName and $mediaType != 'image') {
            $this->message['mediaMessage']['fileName'] = $fileName;
        }

        return $this;
    }

    public function audio(string $url): MessageBuilder
    {
        $this->message['options']['presence'] = 'recording';
        $this->message['options']['encoding'] = true;

        $this->message['audioMessage'] = [
            'audio' => $url,
        ];

        return $this;
    }

    public function mentions(bool $everyOne = true, array $data = []): MessageBuilder
    {
        $this->message['mentions'] = [
            "everyOne" => $everyOne,
        ];

        if (!$everyOne) {
            $this->message['mentions']['mentioned'] = $data;
        }

        return $this;
    }

    public function reply(array $data): MessageBuilder
    {
        $this->message['options']['quoted'] = $data;

        return $this;
    }

    public function location(string $name, $latitude, $longitude): MessageBuilder
    {
        $this->message['locationMessage'] = [
            'name' => $name,
            'latitude' => $latitude,
            'longitude' => $longitude,
        ];

        return $this;
    }

    public function sticker(string $url): MessageBuilder
    {
        $this->message['stickerMessage'] = [
            'image' => $url,
        ];

        return $this;
    }

    public function contact(string $fullName, string $phoneNumber): MessageBuilder
    {
        $this->message['contactMessage'] = [
            [
                'fullName' => $fullName,
                'wuid' => $phoneNumber,
                'phoneNumber' => "+$phoneNumber",
            ]
        ];

        return $this;
    }

    public function templateMessage(string $name, string $language, array $components): MessageBuilder
    {
        $this->message['templateMessage'] = [
            'name' => $name,
            'language' => $language,
            'components' => $components
        ];

        return $this;
    }

    public function hasLocation(): bool
    {
        return isset($this->message['locationMessage']);
    }

    private function hasMedia(): bool
    {
        return isset($this->message['mediaMessage']);
    }

    private function hasText(): bool
    {
        return isset($this->message['textMessage']);
    }

    public function getMessage(): Message
    {
        if ($this->hasMedia() and $this->hasText()) {
            $this->message['mediaMessage']['caption'] = $this->message['textMessage']['text'];
            unset($this->message['textMessage']);
        }

        return new Message($this->message, $this->instance);
    }

    public function customField(string $key, string $value)
    {
        $this->message[$key] = $value;
    }
}
