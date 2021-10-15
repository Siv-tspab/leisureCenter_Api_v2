<?php

namespace App\Service;

use Knp\Component\Pager\PaginatorInterface;

class PaginationService
{
    public function __construct(private PaginatorInterface $paginator)
    {
    }
    public function createPagination($query, $request)
    {
        return $this->paginator->paginate($query, $request->get('page', 1), $_SERVER["PAGINATION_LIMIT"]);
    }
}