<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;

class HttpResponseService
{
    /**
     * Item response
     * @param any $entity the requested entity
     * 
     * @return Response $response http response
     */
    public function getOne($data): Response
    {
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * Collection repsonse
     * @param $data repository of the current entity
     * 
     * @return Response $response
     */
    public function getAll($data): Response
    {
        $response = new Response($data, Response::HTTP_OK);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * Create reponse
     * 
     * @return Response $response
     */
    public function create(): Response
    {
        $response = new Response('', Response::HTTP_CREATED);
        return $response;
    }

    /**
     * Patch reponse
     * @param string $data
     * 
     * @return Response $response
     */
    public function patch(string $data = null): Response
    {
        $response = new Response($data ?? '', Response::HTTP_OK);
        return $response;
    }

    /**
     * Delete response
     * 
     * @return Response $response
     */
    public function delete(): Response
    {
        $response = new Response('', Response::HTTP_NO_CONTENT);
        return $response;
    }

    /**
     * Bad request response
     * 
     * @return Response $response
     */
    public function badRequest(): Response
    {
        $response = new Response('', Response::HTTP_BAD_REQUEST);
        return $response;
    }
}
