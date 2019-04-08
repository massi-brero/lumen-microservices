<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use App\Services\BookService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use function var_dump;

class BookController extends BaseRESTController
{
    /**
     * Access the microservice for authors.
     * @var AuthorService
     */
    private $authorService;

    public function __construct(BookService $bookService, AuthorService $authorService)
    {
        $this->microservice = $bookService;
        $this->authorService = $authorService;
    }

    /**
     * Save one book from a post request by calling the corresponding microservice.
     * First ceck if the author already exists...
     *
     * @param Request $request
     * @return Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function save(Request $request): Response
    {
       $this->authorService->get($request->author_id);

        return $this->successResponse(
            $this->microservice->save(
                $request->all(),
                Response::HTTP_CREATED
            ));
    }
}
