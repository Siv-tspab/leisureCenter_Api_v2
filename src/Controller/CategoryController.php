<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    public function __construct(private CategoryRepository $repository)
    {
    }

    /**
     * @Get(
     *      path = "/categories/{id}",
     *      name = "category_get",
     *      requirements = {"id" = "\d+"}
     * )
     * @View
     */
    public function getOne(Category $category): Category
    {
        return $category;
    }

    /**
     * @Get(
     *      path = "/categories",
     *      name = "category_get_all",
     * )
     * @View
     */
    public function getAll(): array
    {
        return $this->repository->findAll();
    }
}
