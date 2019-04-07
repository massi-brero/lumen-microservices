<?php

namespace App\Services;

use App\Traits\ExternalServicesConsumer;
use Laravel\Lumen\Http\Request;
use function config;

class AuthorService extends BaseRESTService
{
    /**
     * AuthorService constructor.
     */
    public function __construct()
    {
        $this->setBaseUri(config('services.authors.base_uri'));
        $this->setUriPrefix(config('services.authors.prefix'));
    }

}