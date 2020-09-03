<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProduitRepository;
use App\Repository\EmployeeRepository;

class ResponsableController extends AbstractController
{
  /**
   * @Route("/produits", name="produit")
   */
   public function produit(ProduitRepository $pr)
   {
     $produits = $pr->findAll();
     return $this->render('responsable/produits.html.twig',[
       'produits' =>$produits,
     ]);
   }
   /**
    * @Route("/employees", name="employee")
    */
    public function employees(EmployeeRepository $er)
    {
      $employees = $er->findAll();
      return $this->render('responsable/employees.html.twig',[
        'employees' =>$employees,
      ]);
    }

}
