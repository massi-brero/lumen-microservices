<?php

namespace App\Traits;


use App\Services\BaseRESTService;
use function config;
use GuzzleHttp\Client;
use function var_dump;

trait ExternalServicesConsumer
{

    private $baseUri;

    /**
     * @param string $method
     * @param string $uri
     * @param array $formParams
     * @param array $headers
     * @param BaseRESTService|null $callingService
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request(string $method,
                            string $uri,
                            ?array $formParams,
                            ?array $headers,
                            ?BaseRESTService $callingService): string
    {
        $client = new Client([
            'base_uri' =>  $this->getBaseUri(),
        ]);

        if (!is_null($callingService->getSecret()))
        {
            $headers['Authorization'] = $callingService->getSecret();
        }

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