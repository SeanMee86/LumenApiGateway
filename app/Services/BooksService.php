<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class BooksService
{
    use ConsumesExternalService;

    /**
     * the base uri to consume the books service
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
        $this->baseUri = config('services.books.base_uri');
        $this->secret = config('services.books.secret');
    }

    public function obtainBooks()
    {
        return $this->performRequest('GET', '/books');
    }

    public function showBook($id)
    {
        return $this->performRequest('GET', "/books/$id");
    }

    public function createBook($data)
    {
        return $this->performRequest('POST', '/books', $data);
    }

    public function updateBook($data, $id)
    {
        return $this->performRequest('PUT', "/books/$id", $data);
    }

    public function deleteBook($id)
    {
        return $this->performRequest('DELETE', "/books/$id");
    }
}
