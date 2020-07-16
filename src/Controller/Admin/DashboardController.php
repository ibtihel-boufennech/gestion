<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use App\Entity\Produit;
use App\Entity\Categorie;
use App\Entity\SousCategorie;
use App\Entity\Types;
use App\Entity\Employee;


class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        /*return parent::index();*/
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();
        return $this->redirect($routeBuilder->setController(ProduitCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Gestion');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'icon class', EntityClass::class);
        yield MenuItem::linkToCrud('Produit', 'fa fa-home', Produit::class);
        yield MenuItem::linkToCrud('Categorie', 'fa fa-home', Categorie::class);
        yield MenuItem::linkToCrud('Sous categorie', 'fa fa-home', SousCategorie::class);
        yield MenuItem::linkToCrud('Sous sous sategorie', 'fa fa-home', Types::class);
        yield MenuItem::linkToCrud('Employee', 'fa fa-home', Employee::class);
    }
}
