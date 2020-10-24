<?php

namespace App\Http\Controllers;

use App\Services\AuthorsService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorController extends Controller
{

    use ApiResponser;

    /**
     * The service to consume the author microservice
     * @var $authorService
     */
    public $authorService;

    /**
     * Create a new controller instance.
     *
     * @param AuthorsService $authorService
     */
    public function __construct(AuthorsService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * Return the list of authors
     * @return Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function index()
    {
        return $this->successResponse($this->authorService->obtainAuthors());
    }

    /**
     * Create one new author
     * @param Request $request
     * @return Response|\Laravel\Lumen\Http\ResponseFactory
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        return $this->successResponse($this->authorService->createAuthor($request->all()), Response::HTTP_CREATED);
    }

    /**
     * Return information of one author
     * @param $id
     * @return Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function show($id)
    {
        return $this->successResponse($this->authorService->showAuthor($id));
    }

    /**
     * Update information of one author
     * @param Request $request
     * @param $id
     * @return Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function update(Request $request, $id)
    {
        return $this->successResponse($this->authorService->updateAuthor($request->all(), $id));
    }

    /**
     * Remove one author
     * @param $id
     * @return Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function destroy($id)
    {
        return $this->successResponse($this->authorService->deleteAuthor($id));
    }
}
