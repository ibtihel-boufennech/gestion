<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class StatController extends AbstractController
{
    /**
     * @Route("/stat", name="stat")
     */
    public function index(Request $request)
    {
      $stat = new PieChart();
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
