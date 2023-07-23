<?php

namespace App\Controller;

use App\Entity\Candidate;
use App\Entity\Consultant;
use App\Entity\Recruiter;
use App\Entity\User;
use App\Repository\AdRepository;
use App\Repository\CompanyRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecruiterController extends AbstractController
{
    #[Route('/recruiter', name: 'app_recruiter')]
    public function index(
        UserRepository $userRepository,
        CompanyRepository $companyRepository,
        AdRepository $adRepository,
    ): Response
    {

        $user = $this->getUser();
        $type = 0;
                if ($user instanceof Recruiter) {
                    dump($user);
                    
                    $type = 3;
                } else if ($user instanceof Consultant) {
                    $type = 2;
                    return $this->redirectToRoute('app_consultant');
                }

        return $this->render('recruiter/index.html.twig', [
           'user' => $userRepository->findAll(),
           'company' => $companyRepository->findAll(),
           'type' => $type,

        ]);
    }

    #[Route('/mes-annonces/{id}', name: 'app_recruiter_show_ad')]
    public function createAd(
        UserRepository $userRepository,
        CompanyRepository $companyRepository,
        AdRepository $adRepository,
        $id,
    ): Response
    {

        $user = $this->getUser();

        $type = 0;
                if ($user instanceof Recruiter) {
                    dump($user);
                    $type = 3;
                } else if ($user instanceof Consultant) {
                    $type = 2;
                    return $this->redirectToRoute('app_consultant');
                }

        return $this->render('recruiter/show.html.twig', [
           'user' => $userRepository->findOneBy(['id' => $id]),
           'company' => $companyRepository->findAll(),
           'adRepository' => $adRepository->findAll(),

        ]);
    }


}
