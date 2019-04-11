<?php

namespace App\Services;

use \App\Traits\ExternalServicesConsumer;
use function config;

class BookService extends BaseRESTService
{
    public function __construct()
    {
        $this->setBaseUri(config('services.books.base_uri'));
        $this->setUriPrefix(config('services.books.prefix'));
        $this->setSecret(config('services.books.secret'));
    }
}