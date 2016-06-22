<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Vision;
use AppBundle\Form\VisionType;

/**
 * Vision controller.
 *
 */
class VisionController extends Controller
{
    /**
     * Lists all Vision entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $visions = $em->getRepository('AppBundle:Vision')->findAll();

        return $this->render('vision/index.html.twig', array(
            'visions' => $visions,
        ));
    }

    /**
     * Creates a new Vision entity.
     *
     */
    public function newAction(Request $request)
    {
        $vision = new Vision();
        $form = $this->createForm('AppBundle\Form\VisionType', $vision);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($vision);
            $em->flush();

            return $this->redirectToRoute('vision_show', array('id' => $vision->getId()));
        }

        return $this->render('vision/new.html.twig', array(
            'vision' => $vision,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Vision entity.
     *
     */
    public function showAction(Vision $vision)
    {
        $deleteForm = $this->createDeleteForm($vision);

        return $this->render('vision/show.html.twig', array(
            'vision' => $vision,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Vision entity.
     *
     */
    public function editAction(Request $request, Vision $vision)
    {
        $deleteForm = $this->createDeleteForm($vision);
        $editForm = $this->createForm('AppBundle\Form\VisionType', $vision);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($vision);
            $em->flush();

            return $this->redirectToRoute('vision_edit', array('id' => $vision->getId()));
        }

        return $this->render('vision/edit.html.twig', array(
            'vision' => $vision,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Vision entity.
     *
     */
    public function deleteAction(Request $request, Vision $vision)
    {
        $form = $this->createDeleteForm($vision);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($vision);
            $em->flush();
        }

        return $this->redirectToRoute('vision_index');
    }

    /**
     * Creates a form to delete a Vision entity.
     *
     * @param Vision $vision The Vision entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Vision $vision)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('vision_delete', array('id' => $vision->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
