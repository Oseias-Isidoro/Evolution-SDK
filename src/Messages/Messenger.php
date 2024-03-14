<?php

declare(strict_types=1);

namespace EvolutionSDK\Messages;

use EvolutionSDK\HttpClient\API;
use EvolutionSDK\HttpClient\Response;
use GuzzleHttp\Exception\GuzzleException;

class Messenger
{
    private API $API;

    public function __construct(string $base_url, string $token)
    {
        $this->API = new API($base_url, $token);
    }

    /**
     * @throws GuzzleException
     */
    public function send(Message $message): Response
    {
        return $this->API->post(
            $this->getUri($message),
            $message->getData()
        );
    }

    private function getUri(Message $message): string
    {
        if ($message->hasMedia()) {
            return $this->uriGenerator('sendMedia', $message->getInstance());
        }

        if ($message->hasAudio()) {
            return $this->uriGenerator('sendWhatsAppAudio', $message->getInstance());
        }

        if ($message->hasLocation()) {
            return $this->uriGenerator('sendLocation', $message->getInstance());
        }

        if ($message->hasSticker()) {
            return $this->uriGenerator('sendSticker', $message->getInstance());
        }

        if ($message->hasContact()) {
            return $this->uriGenerator('sendContact', $message->getInstance());
        }

        return $this->uriGenerator('sendText', $message->getInstance());
    }

    private function uriGenerator(string $typeMessage, string $instance): string
    {
        return '/message/'. $typeMessage .'/' . $instance;
    }
}