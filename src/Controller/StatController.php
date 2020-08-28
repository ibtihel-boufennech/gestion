<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Produit;
use App\Repository\ProduitRepository;

class StatController extends AbstractController
{
    /**
     * @Route("/stat", name="stat")
     */
    public function index(Request $request,ProduitRepository $produitrepository)
    {
        $produits_epuise = array();

        $produits_pres_fin = array();
        $produits_suffisant = array();
        $produits = $produitrepository->findAll();
        foreach ($produits as $produit) {
          if($produit->getQuantite()==0){

            array_push($produits_epuise,$produit);
          }
          elseif ($produit->getQuantite()<100) {
            array_push($produits_pres_fin,$produit);
          }else {
            array_push($produits_suffisant,$produit);
          }
          if(sizeof($produits_epuise)>sizeof($produits_pres_fin)and sizeof($produits_epuise)>sizeof($produits_suffisant)){
            $length=$produits_epuise;
          }elseif (sizeof($produits_pres_fin)>sizeof($produits_epuise)and sizeof($produits_pres_fin)>sizeof($produits_suffisant)) {
            $length=$produits_pres_fin;
          }else {
            $length=$produits_suffisant;
          }
        }


        return $this->render('stat/index.html.twig',[
          'produits_epuise'=>$produits_epuise,
          'produits_pres_fin'=>$produits_pres_fin,
          'produits_suffisant'=>$produits_suffisant,
          'length'=>$length,
        ]);
    }
    /**
     * @Route("/stat/current", name="_generate_stat")
     */
    public function generate(Stat $stat)
    {
      $pieChart = new PieChart();
    $pieChart->getData()->setArrayToDataTable(
        [['Task', 'Hours per Day'],
         ['Work',     11],
         ['Eat',      2],
         ['Commute',  2],
         ['Watch TV', 2],
         ['Sleep',    7]
        ]
    );
    $pieChart->getOptions()->setTitle('My Daily Activities');
    $pieChart->getOptions()->setHeight(500);
    $pieChart->getOptions()->setWidth(900);
    $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
    $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
    $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
    $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
    $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

    return $this->render('stat/generated.htmltwi', array('piechart' => $pieChart));


  }

}
