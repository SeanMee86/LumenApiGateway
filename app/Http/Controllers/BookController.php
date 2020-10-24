<?php

namespace App\Http\Controllers;

use App\Services\AuthorsService;
use App\Services\BooksService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    use ApiResponser;

    /**
     * The service to consume the books microservice
     * @var $bookService
     */
    public $bookService;

    /**
     * The service to consume the authors microservice
     * @var AuthorsService $authorService
     */
    public $authorService;
    /**
     * Create a new controller instance.
     *
     * @param BooksService $booksService
     */
    public function __construct(BooksService $booksService, AuthorsService $authorsService)
    {
        $this->bookService = $booksService;
        $this->authorService = $authorsService;
    }

    /**
     * Return the list of books
     * @return Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function index()
    {
        return $this->successResponse($this->bookService->obtainBooks());
    }

    /**
     * Create one new book
     * @param Request $request
     * @return Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function store(Request $request)
    {
        $this->authorService->showAuthor($request->author_id);

        return $this->successResponse($this->bookService->createBook($request->all()), Response::HTTP_CREATED);
    }

    /**
     * Return information of one book
     * @param $id
     * @return Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function show($id)
    {
        return $this->successResponse($this->bookService->showBook($id));
    }

    /**
     * Update information of one book
     * @param Request $request
     * @param $id
     * @return Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function update(Request $request, $id)
    {
        return $this->successResponse($this->bookService->updateBook($request->all(), $id));
    }

    /**
     * Remove one book
     * @param $id
     * @return Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function destroy($id)
    {
        return $this->successResponse($this->bookService->deleteBook($id));
    }
}
