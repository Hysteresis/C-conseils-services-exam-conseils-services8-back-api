<?php

namespace App\Controller\Admin;

use App\Entity\Ad;
use App\Entity\AnswerAd;
use App\Entity\Candidate;
use App\Entity\Company;
use App\Entity\Consultant;
use App\Entity\Degree;
use App\Entity\Department;
use App\Entity\EmploymentContract;
use App\Entity\JobCategory;
use App\Entity\JobList;
use App\Entity\Recruiter;
use App\Entity\Salary;
use App\Entity\SalaryCategory;
use App\Entity\Town;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    
    
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    )
    {
        
    }

    #[Route('/89624-saturn-admin', name: 'admin_dashboard')]
    public function index(): Response
    {
            $url = $this->adminUrlGenerator
            ->setController(UserCrudController::class)
            ->generateUrl();
        
        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Conseils Services7');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Annonces', 'fas fa-list', Ad::class);
        yield MenuItem::linkToCrud('Candidats', 'fas fa-list', Candidate::class);
        yield MenuItem::linkToCrud('Consultants-Entreprises', 'fas fa-list', Consultant::class);
        yield MenuItem::linkToCrud('Liste des Villes', 'fas fa-list', Town::class);
        yield MenuItem::linkToCrud('Salaire', 'fas fa-list', Salary::class);
        yield MenuItem::linkToCrud('Liste des recruteurs', 'fas fa-list', Recruiter::class);
        yield MenuItem::linkToCrud('Liste Métiers', 'fas fa-list', JobList::class);
        yield MenuItem::linkToCrud('Catégorie-métiers', 'fas fa-list', JobCategory::class);
        yield MenuItem::linkToCrud('Types de contrats ', 'fas fa-list', EmploymentContract::class);
        yield MenuItem::linkToCrud('Départements', 'fas fa-list', Department::class);
        yield MenuItem::linkToCrud('Diplômes', 'fas fa-list', Degree::class);
        yield MenuItem::linkToCrud('Entreprises', 'fas fa-list', Company::class);
        yield MenuItem::linkToCrud('Réponses aux annonces', 'fas fa-list', AnswerAd::class);
        yield MenuItem::linkToCrud('Types de salaire', 'fas fa-list', SalaryCategory::class);

    }
}
