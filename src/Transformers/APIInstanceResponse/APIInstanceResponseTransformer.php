<?php

namespace EvolutionSDK\Transformers\APIInstanceResponse;

use EvolutionSDK\HttpClient\Response;
use EvolutionSDK\Instances\Instance;

class APIInstanceResponseTransformer
{
    private Response $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function toInstanceObject(): Instance
    {
        $instance = new Instance();

        $response = $this->response->object();

        $instance->setName($response->instance->instanceName);

        if (isset($response->hash->apikey)) $instance->setApikey($response->hash->apikey);

        if (isset($response->qrcode)) {
            $instance->setQrcode((array)$response->qrcode);
        }

        return  $instance;
    }
}