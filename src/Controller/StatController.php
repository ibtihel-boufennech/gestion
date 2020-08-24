<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StatController extends AbstractController
{
    /**
     * @Route("/stat", name="stat")
     */
    public function index(Request $request)
    {
      $stat = new Stat();
        $form = $this->createForm(StatType::class, $stat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            return $this->redirectToRoute('generate_stat');
        }
        return $this->render('stat/indexhtmltwig');
    }
    /**
     * @Route("/stat/current", name="_generate_stat")
     */
    public function generate(Stat $stat)
    {
      $qte_total =
      $produits_epuises=
      $produit_pre_epuises=
      $produit_suffisants=
      return $this->render('stat/generated.htmltwig', [
                                                      'qte_tolal' => $qte_total,
                                                      'produit_epuises' => $produits_epuises,
                                                      '$produit_pre_epuises' => $produit_pre_epuises,
                                                      'trader_ht_dcperiod' => $produit_suffisants
                                                    ]);
  }
    }
}
