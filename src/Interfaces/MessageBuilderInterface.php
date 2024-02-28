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
    public function getMessage();
}