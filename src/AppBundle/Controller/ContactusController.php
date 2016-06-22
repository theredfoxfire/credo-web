<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Contactus;
use AppBundle\Form\ContactusType;

/**
 * Contactus controller.
 *
 */
class ContactusController extends Controller
{
    /**
     * Lists all Contactus entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $contactuses = $em->getRepository('AppBundle:Contactus')->findAll();

        return $this->render('contactus/index.html.twig', array(
            'contactuses' => $contactuses,
        ));
    }

    /**
     * Creates a new Contactus entity.
     *
     */
    public function newAction(Request $request)
    {
        $contactus = new Contactus();
        $form = $this->createForm('AppBundle\Form\ContactusType', $contactus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contactus);
            $em->flush();

            return $this->redirectToRoute('contactus_show', array('id' => $contactus->getId()));
        }

        return $this->render('contactus/new.html.twig', array(
            'contactus' => $contactus,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Contactus entity.
     *
     */
    public function showAction(Contactus $contactus)
    {
        $deleteForm = $this->createDeleteForm($contactus);

        return $this->render('contactus/show.html.twig', array(
            'contactus' => $contactus,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Contactus entity.
     *
     */
    public function editAction(Request $request, Contactus $contactus)
    {
        $deleteForm = $this->createDeleteForm($contactus);
        $editForm = $this->createForm('AppBundle\Form\ContactusType', $contactus);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contactus);
            $em->flush();

            return $this->redirectToRoute('contactus_edit', array('id' => $contactus->getId()));
        }

        return $this->render('contactus/edit.html.twig', array(
            'contactus' => $contactus,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Contactus entity.
     *
     */
    public function deleteAction(Request $request, Contactus $contactus)
    {
        $form = $this->createDeleteForm($contactus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($contactus);
            $em->flush();
        }

        return $this->redirectToRoute('contactus_index');
    }

    /**
     * Creates a form to delete a Contactus entity.
     *
     * @param Contactus $contactus The Contactus entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Contactus $contactus)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('contactus_delete', array('id' => $contactus->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
