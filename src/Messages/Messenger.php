<?php

declare(strict_types=1);

namespace EvolutionSDK\Messages;

use EvolutionSDK\HttpClient\API;
use GuzzleHttp\Exception\GuzzleException;

class Messenger
{
    private API $API;

    public function __construct()
    {
        $this->API = API::getInstance();
    }

    /**
     * @throws GuzzleException
     */
    public function send(Message $message): bool
    {
        $response = $this->API->post(
            $this->getUri($message),
            $message->getData()
        );

        return $response->successful();
    }

    private function getUri(Message $message): string
    {
        if ($message->hasMedia()) {
            return $this->uriGenerator('sendMedia', $message->getInstance());
        }

        if ($message->hasAudio()) {
            return $this->uriGenerator('sendWhatsAppAudio', $message->getInstance());
        }

        return $this->uriGenerator('sendText', $message->getInstance());
    }

    private function uriGenerator(string $typeMessage, string $instance): string
    {
        return '/message/'. $typeMessage .'/' . $instance;
    }
}