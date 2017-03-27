<?php

namespace AppBundle\Controller;

use AppBundle\Entity\FormAnswer;
use AppBundle\Entity\Question;
use AppBundle\Entity\QuestionAnswer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Formanswer controller.
 *
 * @Route("appform/{appform_id}/formanswer")
 */
class FormAnswerController extends Controller
{
    /**
     * Creates a new formAnswer entity.
     *
     * @Route("/new", name="appform_formanswer_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, $appform_id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $appForm = $em->getRepository('AppBundle:AppForm')->find($appform_id);

        $formAnswer = new Formanswer();
        $formAnswer->setUser($user);
        $formAnswer->setAppForm($appForm);
        $questions = $em->getRepository('AppBundle:Question')->findBy(array('appForm'=>$appform_id));
        foreach ($questions as $question) {
            $questionAnswer = new QuestionAnswer();
            $questionAnswer->setQuestion($question);
            $questionAnswer->setFormAnswer($formAnswer);
            $formAnswer->addQuestionAnswer($questionAnswer);
        }
        $form = $this->createForm('AppBundle\Form\FormAnswerType', $formAnswer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($formAnswer);
            $em->flush($formAnswer);

            return $this->redirectToRoute('appform_index');
        }

        return $this->render('formanswer/new.html.twig', array(
            'formAnswer' => $formAnswer,
            'form' => $form->createView(),
            'appform_id' => $appform_id,
        ));
    }
}
