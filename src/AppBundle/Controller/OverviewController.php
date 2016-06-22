<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Overview;
use AppBundle\Form\OverviewType;

/**
 * Overview controller.
 *
 */
class OverviewController extends Controller
{
    /**
     * Lists all Overview entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $overviews = $em->getRepository('AppBundle:Overview')->findAll();

        return $this->render('overview/index.html.twig', array(
            'overviews' => $overviews,
        ));
    }

    /**
     * Creates a new Overview entity.
     *
     */
    public function newAction(Request $request)
    {
        $overview = new Overview();
        $form = $this->createForm('AppBundle\Form\OverviewType', $overview);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($overview);
            $em->flush();

            return $this->redirectToRoute('overview_show', array('id' => $overview->getId()));
        }

        return $this->render('overview/new.html.twig', array(
            'overview' => $overview,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Overview entity.
     *
     */
    public function showAction(Overview $overview)
    {
        $deleteForm = $this->createDeleteForm($overview);

        return $this->render('overview/show.html.twig', array(
            'overview' => $overview,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Overview entity.
     *
     */
    public function editAction(Request $request, Overview $overview)
    {
        $deleteForm = $this->createDeleteForm($overview);
        $editForm = $this->createForm('AppBundle\Form\OverviewType', $overview);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($overview);
            $em->flush();

            return $this->redirectToRoute('overview_edit', array('id' => $overview->getId()));
        }

        return $this->render('overview/edit.html.twig', array(
            'overview' => $overview,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Overview entity.
     *
     */
    public function deleteAction(Request $request, Overview $overview)
    {
        $form = $this->createDeleteForm($overview);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($overview);
            $em->flush();
        }

        return $this->redirectToRoute('overview_index');
    }

    /**
     * Creates a form to delete a Overview entity.
     *
     * @param Overview $overview The Overview entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Overview $overview)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('overview_delete', array('id' => $overview->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
