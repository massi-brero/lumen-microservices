<?php

namespace App\Traits;


use function config;
use GuzzleHttp\Client;

trait ExternalServicesConsumer
{

    private $baseUri;

    /**
     * @param string $method
     * @param string $uri
     * @param array $formParams
     * @param $headers
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request(string $method, string $uri, array $formParams = [], $headers = []): string
    {
        $client = new Client([
            'base_uri' =>  $this->getBaseUri(),
        ]);

        $response = $client->request($method, $uri, [
            'form_params' => $formParams,
            'headers' => $headers
        ]);

        return $response->getBody()->getContents();
    }

    /**
     * @return mixed
     */
    public function getBaseUri()
    {
        return $this->baseUri;
    }

    /**
     * @param mixed $baseUri
     */
    public function setBaseUri($baseUri): void
    {
        $this->baseUri = $baseUri;
    }


}