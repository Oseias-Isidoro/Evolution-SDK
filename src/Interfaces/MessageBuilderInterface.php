<?php

namespace EvolutionSDK\Interfaces;

interface MessageBuilderInterface
{
    public function from(string $instance);
    public function to(string $number);
    public function text(string $text);
    public function media(string $url, string $mediaType, string $fileName = null);
    public function audio(string $url);
    public function mentions(bool $everyOne = true, array $data = []);
    public function reply(array $data);
    public function location(string $name, string $latitude, string $longitude);
    public function sticker(string $url);
    public function contact(string $fullName, string $phoneNumber);
    public function customField(string $key, string $value);
    public function getMessage();
}