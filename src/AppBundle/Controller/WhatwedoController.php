<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Whatwedo;
use AppBundle\Form\WhatwedoType;

/**
 * Whatwedo controller.
 *
 */
class WhatwedoController extends Controller
{
    /**
     * Lists all Whatwedo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $whatwedos = $em->getRepository('AppBundle:Whatwedo')->findAll();

        return $this->render('whatwedo/index.html.twig', array(
            'whatwedos' => $whatwedos,
        ));
    }

    /**
     * Creates a new Whatwedo entity.
     *
     */
    public function newAction(Request $request)
    {
        $whatwedo = new Whatwedo();
        $form = $this->createForm('AppBundle\Form\WhatwedoType', $whatwedo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($whatwedo);
            $em->flush();

            return $this->redirectToRoute('whatwedo_show', array('id' => $whatwedo->getId()));
        }

        return $this->render('whatwedo/new.html.twig', array(
            'whatwedo' => $whatwedo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Whatwedo entity.
     *
     */
    public function showAction(Whatwedo $whatwedo)
    {
        $deleteForm = $this->createDeleteForm($whatwedo);

        return $this->render('whatwedo/show.html.twig', array(
            'whatwedo' => $whatwedo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Whatwedo entity.
     *
     */
    public function editAction(Request $request, Whatwedo $whatwedo)
    {
        $deleteForm = $this->createDeleteForm($whatwedo);
        $editForm = $this->createForm('AppBundle\Form\WhatwedoType', $whatwedo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($whatwedo);
            $em->flush();

            return $this->redirectToRoute('whatwedo_edit', array('id' => $whatwedo->getId()));
        }

        return $this->render('whatwedo/edit.html.twig', array(
            'whatwedo' => $whatwedo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Whatwedo entity.
     *
     */
    public function deleteAction(Request $request, Whatwedo $whatwedo)
    {
        $form = $this->createDeleteForm($whatwedo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($whatwedo);
            $em->flush();
        }

        return $this->redirectToRoute('whatwedo_index');
    }

    /**
     * Creates a form to delete a Whatwedo entity.
     *
     * @param Whatwedo $whatwedo The Whatwedo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Whatwedo $whatwedo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('whatwedo_delete', array('id' => $whatwedo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
