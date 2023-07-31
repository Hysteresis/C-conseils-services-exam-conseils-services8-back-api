<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Entity\Department;
use App\Entity\JobCategory;
use App\Entity\Town;
use App\Repository\AdRepository;
use App\Repository\CompanyRepository;
use App\Repository\DepartmentRepository;
use App\Repository\EmploymentContractRepository;
use App\Repository\JobCategoryRepository;
use App\Repository\JobListRepository;
use App\Repository\RecruiterRepository;
use App\Repository\SalaryRepository;
use App\Repository\TownRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdsController extends AbstractController
{
    #[Route('/offres-d-emploi', name: 'app_ad')]
    public function list(
        AdRepository $ads,
        RecruiterRepository $recruiters,
        CompanyRepository $companys,
        PaginatorInterface $paginator,
        EmploymentContractRepository $employmentContracts,
        Request $request,
    ): Response {

        $adsAll = $ads->findAll();
        $employmentContracts = $employmentContracts->findAll();
        $countAds = $ads->countAds();
        // dd($countAds);
        $pagination = $paginator->paginate(
            $ads->paginationQuery(),
            $request->query->get('page', 1),
            6
        );
        return $this->render('ad/list.html.twig', [
            'ads' => $ads->findAll(),
            'recruiters' => $recruiters->findAll(),
            'companys' => $companys->findAll(),
            'pagination' => $pagination,
            'countAds' => $countAds,
            'employmentContracts' => $employmentContracts
        ]);
    }

    #[Route('/offres-d-emploi/{id}', name: 'app_ad_show_one')]
    public function showOne(
        AdRepository $adRepository,
        TownRepository $townRepository,
        RecruiterRepository $recruiterRepository,
        EmploymentContractRepository $employmentContractRepository,
        JobListRepository $jobListRepository,
        JobCategoryRepository $jobCategoryRepository,
        DepartmentRepository $departmentRepository,
        SalaryRepository $salaryRepository,
        CompanyRepository $companyRepository,
        int $id,
    ): Response 
    {
        // dump($id);
        $townRepository->findAll();
        $recruiterRepository->findAll();     
        $employmentContractRepository->findAll();     
        $jobListRepository->findAll();   
        $jobCategoryRepository->findAll();            
        $departmentRepository->findAll();
        $salaryRepository->findAll();
        $companyRepository->findAll();

        $ad = $adRepository->find($id);
        // dump($ad);


        return $this->render('ad/show_one.html.twig', [
            'ad' => $adRepository->find($id),

        ]);
    }


    #[Route('/offres-d-emploi/list/{id}', name: 'app_ad_by_location', methods: ['GET'])]
    public function adByLocation(
        AdRepository $adRepository,
        TownRepository $townRepository,
        RecruiterRepository $recruiterRepository,
        EmploymentContractRepository $employmentContractRepository,
        JobListRepository $jobListRepository,
        JobCategoryRepository $jobCategoryRepository,
        DepartmentRepository $departmentRepository,
        SalaryRepository $salaryRepository,
        CompanyRepository $companyRepository,
        int $id,
    ): Response {

        $ads = $adRepository->findByTown($id);
        $townRepository->findAll();
        $recruiterRepository->findAll();     
        $employmentContractRepository->findAll();     
        $jobListRepository->findAll();   
        $jobCategoryRepository->findAll();            
        $departmentRepository->findAll();
        $salaryRepository->findAll();
        $companyRepository->findAll();
        $town = $townRepository->find($id);
        // dd($town);



        return $this->render('ad/ad_by_location.html.twig', [
            'ads' => $ads,
            'town' => $town,
        ]);
    }

    


}
