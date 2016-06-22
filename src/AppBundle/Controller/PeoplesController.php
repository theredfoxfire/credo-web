<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Peoples;
use AppBundle\Form\PeoplesType;

/**
 * Peoples controller.
 *
 */
class PeoplesController extends Controller
{
    /**
     * Lists all Peoples entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $peoples = $em->getRepository('AppBundle:Peoples')->findAll();

        return $this->render('peoples/index.html.twig', array(
            'peoples' => $peoples,
        ));
    }

    /**
     * Creates a new Peoples entity.
     *
     */
    public function newAction(Request $request)
    {
        $people = new Peoples();
        $form = $this->createForm('AppBundle\Form\PeoplesType', $people);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($people);
            $em->flush();

            return $this->redirectToRoute('peoples_show', array('id' => $people->getId()));
        }

        return $this->render('peoples/new.html.twig', array(
            'people' => $people,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Peoples entity.
     *
     */
    public function showAction(Peoples $people)
    {
        $deleteForm = $this->createDeleteForm($people);

        return $this->render('peoples/show.html.twig', array(
            'people' => $people,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Peoples entity.
     *
     */
    public function editAction(Request $request, Peoples $people)
    {
        $deleteForm = $this->createDeleteForm($people);
        $editForm = $this->createForm('AppBundle\Form\PeoplesType', $people);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($people);
            $em->flush();

            return $this->redirectToRoute('peoples_edit', array('id' => $people->getId()));
        }

        return $this->render('peoples/edit.html.twig', array(
            'people' => $people,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Peoples entity.
     *
     */
    public function deleteAction(Request $request, Peoples $people)
    {
        $form = $this->createDeleteForm($people);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($people);
            $em->flush();
        }

        return $this->redirectToRoute('peoples_index');
    }

    /**
     * Creates a form to delete a Peoples entity.
     *
     * @param Peoples $people The Peoples entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Peoples $people)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('peoples_delete', array('id' => $people->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
