<?php

namespace App\Services;

use App\Traits\ExternalServicesConsumer;
use Laravel\Lumen\Http\Request;
use function config;

class BaseRESTService
{
    use ExternalServicesConsumer;

    /**
     * The uri for consuming the microservice.
     * @var string
     */
    protected $uri_prefix;

    /**
     * Return all entities from the entity microservice.
     *
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAll()
    {
        return $this->request(Request::METHOD_GET, $this->getUriPrefix());
    }


    /**
     * Create a new entity with the request data from the post request.
     *
     * @param array $requestData
     * @param string $code
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function save(array $requestData, string $code)
    {
        return $this->request(Request::METHOD_POST, $this->getUriPrefix(), $requestData);
    }

    /**
     * Update an existing entity with the request data and the idfrom the post request.
     *
     * @param array $requestData
     * @param string $code
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update(array $requestData, int $id)
    {
        return $this->request(Request::METHOD_PUT, $this->getUriPrefix() . '/' . $id, $requestData);
    }

    /**
     * Return one entity from the entity microservice.
     *
     * @param int $id
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(int $id)
    {
        return $this->request(Request::METHOD_GET, $this->getUriPrefix() . '/' . $id);
    }

    /**
     * Delete one entity from the entity microservice.
     **
     * @param int $id
     * @return string the deleted entity
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete(int $id)
    {
        return $this->request(Request::METHOD_DELETE, $this->getUriPrefix() . '/' . $id);
    }

    /**
     * @return mixed
     */
    protected function getUriPrefix()
    {
        return $this->uri_prefix;
    }

    /**
     * @param mixed $uri_prefix
     */
    protected function setUriPrefix($uri_prefix): void
    {
        $this->uri_prefix = $uri_prefix;
    }


}