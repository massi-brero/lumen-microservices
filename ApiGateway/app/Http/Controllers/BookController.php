<?php

namespace App\Http\Controllers;

use App\Services\BookService;

class BookController extends BaseRESTController
{
    public function __construct(BookService $bookService)
    {
        $this->microservice = $bookService;
    }
}
