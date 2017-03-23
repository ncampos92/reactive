<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

//http://symfony.com/doc/current/security/form_login_setup.html
class SecurityController extends Controller
{
  /**
   * @Route("/login", name="login")
   */
  public function loginAction(Request $request)
  {
    $authenticationUtils = $this->get('security.authentication_utils');

    // get the login error if there is one
    $error = $authenticationUtils->getLastAuthenticationError();

    // last username entered by the user
    $lastEmail = $authenticationUtils->getLastUsername();

    return $this->render('security/login.html.twig', array(
        'last_email' => $lastEmail,
        'error'         => $error,
    ));
  }
}
