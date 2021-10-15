<?php

namespace App\Controller;

use App\Entity\LeisureCenter;
use App\Form\LeisureCenterType;
use App\Repository\LeisureCenterRepository;
use App\Service\GeoLocationService;
use App\Service\HttpResponseService;
use App\Service\PaginationService;
use App\Service\WeatherService;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LeisureCenterController extends AbstractController
{
    public function __construct(
        private LeisureCenterRepository $repository,
        private EntityManagerInterface $em,
        private SerializerInterface $serializer,
        private HttpResponseService $httpResponse,
        private PaginationService $paginator,
        private WeatherService $weather,
        private GeoLocationService $geoLocation,
    ) {
    }

    #[Route('/leisureCenters/{id}', name: 'leisure_center_get', methods: 'GET', requirements: ['id' => '\d+'])]
    public function getOne(LeisureCenter $leisureCenter): Response
    {
        $leisureCenter->setWeather($this->weather->getWeather($leisureCenter->getCoordinates()));
        $data = $this->serializer->serialize($leisureCenter, 'json', SerializationContext::create()->setGroups(['detail']));
        return $this->httpResponse->getOne($data);
    }

    #[Route('/leisureCenters', name: 'leisure_center_getAll', methods: 'GET')]
    public function getAll(Request $request): Response
    {
        $query = $this->repository->getFindAllQuery();
        $leisureCenters = $this->paginator->createPagination($query, $request);
        foreach ($leisureCenters as $leisureCenter) {
            $leisureCenter->setWeather($this->weather->getWeather($leisureCenter->getCoordinates()));
        }
        $data = $this->serializer->serialize($leisureCenters, 'json', SerializationContext::create()->setGroups([
            'Default',
            'items' => ['list']
        ]));
        return $this->httpResponse->getAll($data);
    }

    #[Route('/leisureCenters', name: 'leisure_center_create', methods: 'POST')]
    public function create(Request $request): Response
    {
        $form = $this->createForm(LeisureCenterType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $center = $form->getData();
            $center->setCoordinates($this->geoLocation->getCoordinates($center->getAddress()));

            $this->em->persist($center);
            $this->em->flush();
            return $this->httpResponse->patch();
        }
        return $this->httpResponse->badRequest();
    }

    #[Route('/leisureCenters/{id}', name: 'leisure_center_patch', methods: 'PATCH')]
    public function patch(Request $request): Response
    {
        $leisureCenter = $this->repository->find($request->get('id'));
        $form = $this->createForm(LeisureCenterType::class, $leisureCenter, ['method' => 'PATCH']);
        $form->submit($request->toArray(), false);

        if ($form->isSubmitted() && $form->isValid()) {
            $leisureCenter = $form->getData();
            $this->em->persist($leisureCenter);
            $this->em->flush();

            $data = $this->serializer->serialize($leisureCenter, 'json', SerializationContext::create()->setGroups(['detail']));
            return $this->httpResponse->patch($data);
        }
        return $this->httpResponse->badRequest();
    }

    #[Route('/leisureCenters/{id}', name: 'leisure_center_delete', methods: 'DELETE')]
    public function delete(LeisureCenter $leisureCenter): Response
    {
        $this->em->remove($leisureCenter);
        $this->em->flush();
        return $this->httpResponse->delete($leisureCenter);
    }
}
