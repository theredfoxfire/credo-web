<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Whoweare;
use AppBundle\Form\WhoweareType;

/**
 * Whoweare controller.
 *
 */
class WhoweareController extends Controller
{
    /**
     * Lists all Whoweare entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $whoweares = $em->getRepository('AppBundle:Whoweare')->findAll();

        return $this->render('whoweare/index.html.twig', array(
            'whoweares' => $whoweares,
        ));
    }

    /**
     * Creates a new Whoweare entity.
     *
     */
    public function newAction(Request $request)
    {
        $whoweare = new Whoweare();
        $form = $this->createForm('AppBundle\Form\WhoweareType', $whoweare);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($whoweare);
            $em->flush();

            return $this->redirectToRoute('whoweare_show', array('id' => $whoweare->getId()));
        }

        return $this->render('whoweare/new.html.twig', array(
            'whoweare' => $whoweare,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Whoweare entity.
     *
     */
    public function showAction(Whoweare $whoweare)
    {
        $deleteForm = $this->createDeleteForm($whoweare);

        return $this->render('whoweare/show.html.twig', array(
            'whoweare' => $whoweare,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Whoweare entity.
     *
     */
    public function editAction(Request $request, Whoweare $whoweare)
    {
        $deleteForm = $this->createDeleteForm($whoweare);
        $editForm = $this->createForm('AppBundle\Form\WhoweareType', $whoweare);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($whoweare);
            $em->flush();

            return $this->redirectToRoute('whoweare_edit', array('id' => $whoweare->getId()));
        }

        return $this->render('whoweare/edit.html.twig', array(
            'whoweare' => $whoweare,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Whoweare entity.
     *
     */
    public function deleteAction(Request $request, Whoweare $whoweare)
    {
        $form = $this->createDeleteForm($whoweare);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($whoweare);
            $em->flush();
        }

        return $this->redirectToRoute('whoweare_index');
    }

    /**
     * Creates a form to delete a Whoweare entity.
     *
     * @param Whoweare $whoweare The Whoweare entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Whoweare $whoweare)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('whoweare_delete', array('id' => $whoweare->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
