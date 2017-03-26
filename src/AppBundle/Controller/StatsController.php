<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
    $em = $this->getDoctrine()->getManager();
    $appForm = $em->getRepository('AppBundle:AppForm')->find($id);

    return $this->render('stats/show.html.twig', array(
      'appForm' => $appForm,
    ));
  }

}
