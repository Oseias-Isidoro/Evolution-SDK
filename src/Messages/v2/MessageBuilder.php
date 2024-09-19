<?php

declare(strict_types=1);

namespace EvolutionSDK\Messages\v2;

use EvolutionSDK\Interfaces\MessageBuilderInterface;
use EvolutionSDK\Messages\Message;

class MessageBuilder implements MessageBuilderInterface
{
    private array $message;
    private string $instance;

    public function __construct()
    {
        $this->message = [
            "delay" => 1200,
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
        $this->message['text'] = $text;

        return $this;
    }

    public function media(string $url, string $mediaType, string $fileName = null): MessageBuilder
    {
        $this->message['mediatype'] = $mediaType;
        $this->message['media'] = $url;

        if ($fileName and $mediaType != 'image') {
            $this->message['fileName'] = $fileName;
        }

        return $this;
    }

    public function audio(string $url): MessageBuilder
    {
        $this->message['presence'] = 'recording';
        $this->message['encoding'] = true;
        $this->message['audio'] = $url;

        return $this;
    }

    public function mentions(bool $everyOne = true, array $data = []): MessageBuilder
    {
        $this->message['mentionsEveryOne'] = $everyOne;

        if (!$everyOne) {
            $this->message['mentioned'] = $data;
        }

        return $this;
    }

    public function reply(array $data): MessageBuilder
    {
        $this->message['quoted'] = $data;

        return $this;
    }

    public function location(string $name, $latitude, $longitude): MessageBuilder
    {
        $this->message['name'] = $name;
        $this->message['latitude'] = $latitude;
        $this->message['longitude'] = $longitude;

        return $this;
    }

    public function sticker(string $url): MessageBuilder
    {
        $this->message['sticker'] = $url;

        return $this;
    }

    public function contact(string $fullName, string $phoneNumber): MessageBuilder
    {
        $this->message['contact'][] = [
            'fullName' => $fullName,
            'wuid' => $phoneNumber,
            'phoneNumber' => "+$phoneNumber",
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
            $this->message['caption'] = $this->message['text'];
            unset($this->message['text']);
        }

        return new Message($this->message, $this->instance);
    }

    public function customField(string $key, string $value)
    {
        $this->message[$key] = $value;
    }
}