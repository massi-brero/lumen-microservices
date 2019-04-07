<?php

namespace App\Http\Controllers;

use App\Author;
use App\Services\microservice;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BaseRESTController extends Controller
{
    use ApiResponser;

    /**
     * The service to consume the entities microservice.
     * @var microservice
     */
    protected $microservice;
    
    /**
     * Get all entities from the microservice.
     *
     * @return Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function index(): Response
    {
        return $this->successResponse($this->microservice->getAll());
    }

    /**
     * Save one entity from a post request by calling the corresponding microservice.
     *
     * @param Request $request
     * @return Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function save(Request $request): Response
    {
        return $this->successResponse(
            $this->microservice->save(
                $request->all(),
                Response::HTTP_CREATED
            ));
    }

    /**
     * Get entity found by $id.
     *
     * @param int $id
     * @return Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(int $id): Response
    {
        return $this->successResponse(
            $this->microservice->get(
                $id
            ));
    }

    /**
     * Update an existing entity
     *
     * @param Request $request
     * @param int $id
     * @return Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update(Request $request, int $id): Response
    {
        return $this->successResponse(
            $this->microservice->update(
                $request->all(),
                $id
            ));
    }

    /**
     * Remove entity by its id.
     *
     * @param int $id
     * @return Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete(int $id): Response
    {
        return $this->successResponse(
            $this->microservice->delete(
                $id
            ));
    }

}
