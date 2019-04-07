<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;

class AuthorController extends BaseRESTController
{

    public function __construct(AuthorService $authorService)
    {
        $this->microservice = $authorService;
    }
}
