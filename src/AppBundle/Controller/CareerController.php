<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Career;
use AppBundle\Form\CareerType;

/**
 * Career controller.
 *
 */
class CareerController extends Controller
{
    /**
     * Lists all Career entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $careers = $em->getRepository('AppBundle:Career')->findAll();

        return $this->render('career/index.html.twig', array(
            'careers' => $careers,
        ));
    }

    /**
     * Creates a new Career entity.
     *
     */
    public function newAction(Request $request)
    {
        $career = new Career();
        $form = $this->createForm('AppBundle\Form\CareerType', $career);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($career);
            $em->flush();

            return $this->redirectToRoute('career_show', array('id' => $career->getId()));
        }

        return $this->render('career/new.html.twig', array(
            'career' => $career,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Career entity.
     *
     */
    public function showAction(Career $career)
    {
        $deleteForm = $this->createDeleteForm($career);

        return $this->render('career/show.html.twig', array(
            'career' => $career,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Career entity.
     *
     */
    public function editAction(Request $request, Career $career)
    {
        $deleteForm = $this->createDeleteForm($career);
        $editForm = $this->createForm('AppBundle\Form\CareerType', $career);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($career);
            $em->flush();

            return $this->redirectToRoute('career_edit', array('id' => $career->getId()));
        }

        return $this->render('career/edit.html.twig', array(
            'career' => $career,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Career entity.
     *
     */
    public function deleteAction(Request $request, Career $career)
    {
        $form = $this->createDeleteForm($career);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($career);
            $em->flush();
        }

        return $this->redirectToRoute('career_index');
    }

    /**
     * Creates a form to delete a Career entity.
     *
     * @param Career $career The Career entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Career $career)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('career_delete', array('id' => $career->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}