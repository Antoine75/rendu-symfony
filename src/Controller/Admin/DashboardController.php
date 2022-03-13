<?php

namespace App\Controller\Admin;

use App\Controller\InvoiceController;
use App\Entity\Invoice;
use App\Entity\Project;
use App\Entity\ProjectCategory;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        parent::index();
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(ProjectCategoryCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Rendu Td 3');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Project');
        yield MenuItem::linkToCrud('Invoices', 'fas fa-scroll', Invoice::class);
        yield MenuItem::linkToCrud('Projects', 'fas fa-boxes', Project::class);
        yield MenuItem::linkToCrud('Projects Category',  'fa fa-laptop-code', ProjectCategory::class);
        yield MenuItem::section('Admin');
        yield MenuItem::linkToCrud('Users', 'fas fa-user', User::class);

    }
}
