<?php

namespace App\Controller;

use App\Entity\Center;
use App\Form\CenterType;
use App\Repository\CenterRepository;
use App\Service\GeoLocationService;
use App\Service\PaginationService;
use App\Service\WeatherService;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Patch;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Delete;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation\Operation as Doc;


class CenterController extends AbstractFOSRestController
{
    public function __construct(
        private CenterRepository $repository,
        private EntityManagerInterface $em,
        private SerializerInterface $serializer,
        private PaginationService $paginator,
        private WeatherService $weather,
        private GeoLocationService $geoLocation,
    ) {
    }

    /**
     * @Get(
     *      path = "/centers/{id}",
     *      name = "centers_get",
     *      requirements = {"id" = "\d+"}
     * )
     * @View
     * @Doc(
     *     path = "/centers/{id}",
     *     description="Get the list of all articles."
     * )
     */
    public function getOne(Center $center): Center
    {
        $center->setWeather($this->weather->getWeather($center->getCoordinates()));
        return $center;
    }

    /**
     * @Get(
     *      path = "/centers",
     *      name = "centers_get_all",
     * )
     */
    public function getAll(Request $request)
    {
        $query = $this->repository->getFindAllQuery($request->get('name'), $request->get('category')); // TODO: enhance filters
        $centers = $this->paginator->createPagination($query, $request);

        $data = $this->serializer->serialize($centers, 'json');
        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    /**
     * @Post(
     *      path = "/centers",
     *      name = "centers_create",
     * )
     * @View
     */
    public function create(Request $request)
    {
        $data = $this->serializer->deserialize($request->getContent(), 'array', 'json');
        $form = $this->createForm(CenterType::class, new Center);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {

            $center = $form->getData();
            $center->setCoordinates($this->geoLocation->getCoordinates($center->getAddress()));

            $this->em->persist($center);
            $this->em->flush();

            return $this->view(
                $center,
                Response::HTTP_CREATED,
                [
                    'Location' => $this->generateUrl('centers_get', ['id' => $center->getId()], UrlGeneratorInterface::ABSOLUTE_URL)
                ]
            );
        }
        return new Response('', Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Patch(
     *      path = "/centers/{id}",
     *      name = "centers_patch",
     *      requirements = {"id" = "\d+"}
     * )
     * @View
     */
    public function patch(Request $request)
    {
        $center = $this->repository->find($request->get('id'));
        $data = $this->serializer->deserialize($request->getContent(), 'array', 'json');

        $form = $this->createForm(CenterType::class, $center, ['method' => 'PATCH']);
        $form->submit($data, false);

        if ($form->isSubmitted() && $form->isValid()) {

            $center = $form->getData();
            $this->em->persist($center);
            $this->em->flush();

            return $this->view(
                $center,
                Response::HTTP_OK,
                [
                    'Location' => $this->generateUrl('centers_get', ['id' => $center->getId()], UrlGeneratorInterface::ABSOLUTE_URL)
                ]
            );
        }
        return new Response('', Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Delete(
     *      path = "/centers/{id}",
     *      name = "centers_delete",
     *      requirements = {"id" = "\d+"}
     * )
     */
    public function delete(Center $center): Response
    {
        $this->em->remove($center);
        $this->em->flush();
        return new Response('', Response::HTTP_NO_CONTENT);
    }
}
