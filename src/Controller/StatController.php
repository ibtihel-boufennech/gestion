<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Produit;
use App\Entity\Statistique;

use App\Repository\ProduitRepository;
use App\Repository\StatistiqueRepository;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Spipu\Html2Pdf\Html2Pdf;

class StatController extends AbstractController
{
    private $html2pdf;
    public function __construct(HTML2PDF $myhtml2pdf)
    {
      $this->html2pdf = $myhtml2pdf;
    }
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
          }}
          if(sizeof($produits_epuise)>sizeof($produits_pres_fin)and sizeof($produits_epuise)>sizeof($produits_suffisant)){
            $length=$produits_epuise;
          }elseif (sizeof($produits_pres_fin)>sizeof($produits_epuise)and sizeof($produits_pres_fin)>sizeof($produits_suffisant)) {
            $length=$produits_pres_fin;
          }else {
            $length=$produits_suffisant;
          }
 
        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable(
        [['Produits', 'Quantité'],
         ['epuisés',    sizeof($produits_epuise) ],
         ['prés fin',   sizeof($produits_pres_fin)   ],
         ['suffisants', sizeof($produits_suffisant) ]
        
        ]
         );
        $pieChart->getOptions()->setTitle('Produits');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

        return $this->render('stat/index.html.twig',[
          'produits_epuise'=>$produits_epuise,
          'produits_pres_fin'=>$produits_pres_fin,
          'produits_suffisant'=>$produits_suffisant,
          'length'=>$length,
          'piechart'=>$pieChart,
        ]);
    }

    /**
     * @Route("/stat/new", name="stat_new")
     */
    public function new(ProduitRepository $produitrepository)
    {
      $stat = new Statistique();
      $date = date("Y/m/d");
      $stat->setDateStat(\DateTime::createFromFormat('Y/m/d', $date));
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
        }
      $stat->setProduitEpuise($produits_epuise);
      $stat->setProduitPresFin($produits_pres_fin);
      $stat->setProduitSuffisant($produits_suffisant);
      $entitymanager=$this->getDoctrine()->getManager();
      $entitymanager->persist($stat);
      $entitymanager->flush();
      return $this->render("index.html.twig",[
        'success'=>"Statistique enregistré avec succes"
      ]);

    }
    /**
     * @Route("/stat/print", name="print_stat")
     */
    public function print(StatistiqueRepository $statprod)
    {
      
       $stat = $statprod->findAll();
       $template = $this->renderview('stat/print.html.twig',[
        'produits_epuise'=>$stat->getProduitEpuise(),
        'produits_suffisant'=>$stat->getProduitSuffisant(),
        'produitspresfin'=>$stat->getProduitPresFin(),
        'datestat'=>$stat->getDateStat(),
      ]);
       return $this->html2pdf->writeHTML($template)->output();
    }
    
}
