<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class AuthorsService
{
    use ConsumesExternalService;

    /**
     * the base uri to consume the authors service
     * @var $baseUri
     */
    public $baseUri;

    /**
     * the base uri to consume the authors service
     * @var $baseUri
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.authors.base_uri');
        $this->secret = config('services.authors.secret');
    }

    public function obtainAuthors()
    {
        return $this->performRequest('GET', '/authors');
    }

    public function showAuthor($id)
    {
        return $this->performRequest('GET', "/authors/$id");
    }

    public function createAuthor($data)
    {
        return $this->performRequest('POST', '/authors', $data);
    }

    public function updateAuthor($data, $id)
    {
        return $this->performRequest('PUT', "/authors/$id", $data);
    }

    public function deleteAuthor($id)
    {
        return $this->performRequest('DELETE', "/authors/$id");
    }
}
