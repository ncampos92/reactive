<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Question;
use AppBundle\Entity\AppForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Question controller.
 *
 * @Route("appform/{appform_id}/question")
 */
class QuestionController extends Controller
{
    /**
     * Creates a new question entity.
     *
     * @Route("/new", name="appform_question_new")
     * @Method({"POST"})
     */
    public function newAction(Request $request, $appform_id)
    {
        $question = new Question();
        $form = $this->createForm('AppBundle\Form\QuestionType', $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $appForm = $em->getRepository('AppBundle:AppForm')->find($appform_id);
            $question->setAppForm($appForm);

            $em->persist($question);
            $em->flush();
        }

        return $this->redirectToRoute('appform_show', array('id' => $appform_id));
    }

    /**
     * Displays a form to edit an existing question entity.
     *
     * @Route("/{id}/edit", name="appform_question_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, $appform_id, Question $question)
    {
        $deleteForm = $this->createDeleteForm($question);
        $editForm = $this->createForm('AppBundle\Form\QuestionType', $question);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('appform_show', array(
                                                'id' => $appform_id,
                                            ));
        }

        return $this->render('question/edit.html.twig', array(
            'question' => $question,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'appform_id' => $appform_id,
        ));
    }

    /**
     * Deletes a question entity.
     *
     * @Route("/{id}", name="appform_question_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Question $question)
    {
        $form = $this->createDeleteForm($question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($question);
            $em->flush();
        }

        return $this->redirectToRoute('appform_show', array('id' => $question->getAppForm()->getId(), ));
    }

    /**
     * Creates a form to delete a question entity.
     *
     * @param Question $question The question entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Question $question)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('appform_question_delete', array(
                                                'id' => $question->getId(),
                                                'appform_id' => $question->getAppForm()->getId(),
                                            )))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
