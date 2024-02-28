## Description
A simple SDK for https://github.com/EvolutionAPI/evolution-api. \
This uses the BUILDER design pattern to create the message request.

## Install
``
composer require "oseias-isidoro/evoluiton-sdk"
``
 
in your .env

```text
EVOLUTION_TOKEN='{TOKEN}'
EVOLUTION_URL='https://evolution.com'
```

## Quick start and examples

* just text
```php
require __DIR__ . '/vendor/autoload.php';

use EvolutionSDK\Messages\MessageBuilder;
use EvolutionSDK\Messages\Messenger;

$builder = new MessageBuilder();

$message = $builder
    ->from('[instance]')
    ->to('[remoteJid]')
    ->text('simple text')
    ->getMessage();


if ((new Messenger())->send($message)) {
    echo "success";
} else {
    echo "error";
}

```

## MessageBuilder methods available
#### Media:
```php
    media(string $url, string $mediaType, string $fileName = null);
    
    $builder->media(
        'https://path_to_file',
        'document', // document, image, video
        'file_name' // Optional, just for document media type 
    );
```    
#### Audio:
```php
    audio(string $url);
    
    $builder->audio('https://path_to_file');
```
#### Mentions:
```php
    mentions(bool $everyOne = true, array $data = []);
    
    $builder->mentions(false, [
        "[remoteJid]",
        "[remoteJid]",
    ]);
```
#### Reply:
```php
    reply(array $data);
    
    $builder->reply([
        "key" => [
            "remoteJid" => "[remoteJid]@s.whatsapp.net",
            "fromMe" => "true",
            "id" => "BAE5766236A2AEFF",
            "participant" => "",
        ],
        "message" => [
            "conversation" => "Plain text message, sent with the _Evolution-API_ 🚀."
        ]
    ]);
```

## Supported messages type 

| type                                                                           | * |
|--------------------------------------------------------------------------------|--|
| Send Text                                                                      | ✔ |
| Send Buttons                                                                   | ❌ |
| Send Template                                                                  | ❌ |
| Send Media: audio - video - image - document - gif <br></br>base64: ```true``` | ✔ |
| Send Media File                                                                | ✔ |
| Send Audio type WhatsApp                                                       | ✔ |
| Send Audio type WhatsApp - File                                                | ✔ |
| Send Location                                                                  | ✔ |
| Send List                                                                      | ❌ |
| Send Link Preview                                                              | ❌ |
| Send Contact                                                                   | ✔ |
| Send Reaction - emoji                                                          | ✔ |