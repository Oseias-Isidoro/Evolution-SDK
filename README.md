## Install
``
composer require "oseias-isidoro/evoluiton-sdk"
``
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
* just text with replay
```php
require __DIR__ . '/vendor/autoload.php';

use EvolutionSDK\Messages\MessageBuilder;
use EvolutionSDK\Messages\Messenger;

$builder = new MessageBuilder();

$message = $builder
    ->from('[instance]')
    ->to('[remoteJid]')
    ->text('simple text')
    ->reply([
        "key" => [
            "id" => "BAE5A93426089623",
        ],
    ])
    ->getMessage();


if ((new Messenger())->send($message)) {
    echo "success";
} else {
    echo "error";
}

```
* media with caption (for no caption just remove ->text())
```php
require __DIR__ . '/vendor/autoload.php';

use EvolutionSDK\Messages\MessageBuilder;
use EvolutionSDK\Messages\Messenger;

$builder = new MessageBuilder();

$message = $builder
    ->from('[instance]')
    ->to('[remoteJid]')
    ->text('simple text')
    ->media(
        'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf',
        'document',
        'FileName'
    )
    ->reply([
        "key" => [
            "id" => "BAE5A93426089623",
        ],
    ])
    ->getMessage();


if ((new Messenger())->send($message)) {
    echo "success";
} else {
    echo "error";
}

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
| Send Location                                                                  | ❌ |
| Send List                                                                      | ❌ |
| Send Link Preview                                                              | ❌ |
| Send Contact                                                                   | ❌ |
| Send Reaction - emoji                                                          | ✔ |