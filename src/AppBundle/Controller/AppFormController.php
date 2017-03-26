<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AppForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Appform controller.
 *
 * @Route("appform")
 */
class AppFormController extends Controller
{
    /**
     * Lists all appForm entities.
     *
     * @Route("/", name="appform_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $appForms = $em->getRepository('AppBundle:AppForm')->findAll();

        return $this->render('appform/index.html.twig', array(
            'appForms' => $appForms,
        ));
    }

    /**
     * Creates a new appForm entity.
     *
     * @Route("/new", name="appform_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $appForm = new Appform();
        $form = $this->createForm('AppBundle\Form\AppFormType', $appForm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $appForm->setCreatedBy($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($appForm);
            $em->flush();

            return $this->redirectToRoute('appform_show', array('id' => $appForm->getId()));
        }

        return $this->render('appform/new.html.twig', array(
            'appForm' => $appForm,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a appForm entity.
     *
     * @Route("/{id}", name="appform_show")
     * @Method("GET")
     */
    public function showAction(AppForm $appForm)
    {
        $deleteForm = $this->createDeleteForm($appForm);

        return $this->render('appform/show.html.twig', array(
            'appForm' => $appForm,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing appForm entity.
     *
     * @Route("/{id}/edit", name="appform_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, AppForm $appForm)
    {
        $deleteForm = $this->createDeleteForm($appForm);
        $editForm = $this->createForm('AppBundle\Form\AppFormType', $appForm);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('appform_edit', array('id' => $appForm->getId()));
        }

        return $this->render('appform/edit.html.twig', array(
            'appForm' => $appForm,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a appForm entity.
     *
     * @Route("/{id}", name="appform_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, AppForm $appForm)
    {
        $form = $this->createDeleteForm($appForm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($appForm);
            $em->flush();
        }

        return $this->redirectToRoute('appform_index');
    }

    /**
     * Creates a form to delete a appForm entity.
     *
     * @param AppForm $appForm The appForm entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AppForm $appForm)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('appform_delete', array('id' => $appForm->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
