<?php

namespace App\Controller;

use App\Repository\AdRepository;
use App\Repository\EmploymentContractRepository;
use App\Repository\TownRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['POST', 'GET'])]
    public function index(
        AdRepository $ads,
    ): Response
    {

        $adsAll = $ads->findAll();
        $countAds = $ads->countAds();
        return $this->render('home/home.html.twig',[
            'ads' => $ads->findAll(),
            'countAds' => $countAds,
        ]);
    }

    #[Route('/search-town', name: 'app_search_town', methods: ['POST', 'GET'])]
    public function searchTown(
        Request $request,
        TownRepository $townRepository,
        SerializerInterface $serializer,
        )
    {
        $content = $request->getContent();

        $data = json_decode($content, true);
        $letterTown = $data['value'];
        $listTowns = $townRepository->findByTown($letterTown);
        $jsonData = $serializer->serialize($listTowns, 'json', ['groups' => 'read']);
        $response = new JsonResponse($jsonData);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }


}
