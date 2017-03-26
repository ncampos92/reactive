<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ob\HighchartsBundle\Highcharts\Highchart;

/**
 * Statistics controller.
 *
 * @Route("stats")
 */
class StatsController extends Controller
{
  /**
   * List all appforms available to view stats
   *
   * @Route("/", name="stats_index")
   * @Method("GET")
   */
  public function indexAction()
  {
    $em = $this->getDoctrine()->getManager();

    $appForms = $em->getRepository('AppBundle:AppForm')->findAll();

    return $this->render('stats/index.html.twig', array(
      'appForms' => $appForms,
    ));
  }

  /**
   * Show stats of an appform
   *
   * @Route("/{id}", name="stats_show")
   * @Method("GET")
   */
  public function showAction($id)
  {
    $cumple = 0;
    $noCumple = 0;
    $noAplica = 0;

    $em = $this->getDoctrine()->getManager();
    $appForm = $em->getRepository('AppBundle:AppForm')->find($id);

    foreach ($appForm->getFormAnswers() as $formAnswer) {
      foreach ($formAnswer->getQuestionAnswers() as $questionAnswer) {
        switch ($questionAnswer->getValue()) {
          case 'cu':
            $cumple++;
            break;
          case 'nc':
            $noCumple++;
            break;
          default:
            $noAplica++;
            break;
        }
      }
    }

    $ob = new Highchart();
    $ob->chart->renderTo('piechart');
    $ob->title->text('General');
    $ob->plotOptions->pie(array(
        'allowPointSelect'  => true,
        'cursor'    => 'pointer',
        'dataLabels'    => array('enabled' => false),
        'showInLegend'  => true
    ));
    $data = array(
        array('Cumple', $cumple),
        array('No Cumple', $noCumple),
        array('No Aplica', $noAplica),
    );
    $ob->series(array(array('type' => 'pie','name' => 'Total de Respuestas', 'data' => $data)));

    return $this->render('stats/show.html.twig', array(
      'appForm' => $appForm,
      'chart' => $ob,
    ));
  }

}
