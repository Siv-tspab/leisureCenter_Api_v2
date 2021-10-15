<?php

namespace App\Controller;

use App\Entity\LeisureCategory;
use App\Repository\LeisureCategoryRepository;
use App\Service\HttpResponseService;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LeisureCategoryController extends AbstractController
{
    public function __construct(private LeisureCategoryRepository $repository, private SerializerInterface $serializer, private HttpResponseService $httpResponse)
    {
    }

    #[Route('/leisureCategories/{id}', name: 'leisure_category_get', methods: 'GET', requirements: ['id' => '\d+'])]
    public function getOne(LeisureCategory $leisureCategory): Response
    {
        $data = $this->serializer->serialize($leisureCategory, 'json', SerializationContext::create()->setGroups(['detail']));
        return $this->httpResponse->getOne($data);
    }

    #[Route('/leisureCategories', name: 'leisure_category_getAll', methods: 'GET')]
    public function getAll(): Response
    {
        $categories = $this->repository->findAll();
        $data = $this->serializer->serialize($categories, 'json', SerializationContext::create()->setGroups(['list']));
        return $this->httpResponse->getAll($data);
    }
}