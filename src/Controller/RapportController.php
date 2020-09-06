<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RapportController extends AbstractController
{
    /**
     * @Route("/rapport", name="rapport")
     */
    public function add()
    {
        return $this->render('rapport/index.html.twig', [
            'controller_name' => 'RapportController',
        ]);
    }

    public function finalize()
    {
    	# code...
    }
}
