<?php

namespace EvolutionSDK\Interfaces;

interface MessageBuilderInterface
{
    public function from(string $instance): MessageBuilderInterface;
    public function to(string $number): MessageBuilderInterface;
    public function text(string $text): MessageBuilderInterface;
    public function media(string $url, string $mediaType, string $fileName = null): MessageBuilderInterface;
    public function audio(string $url): MessageBuilderInterface;
    public function mentions(bool $everyOne = true, array $data = []): MessageBuilderInterface;
    public function reply(array $data): MessageBuilderInterface;
    public function location(string $name, string $latitude, string $longitude): MessageBuilderInterface;
    public function sticker(string $url): MessageBuilderInterface;
    public function contact(string $fullName, string $phoneNumber): MessageBuilderInterface;
    public function templateMessage(string $name, string $language, array $components): MessageBuilderInterface;
    public function customField(string $key, string $value);
    public function getMessage();
}