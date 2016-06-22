<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Csr;
use AppBundle\Form\CsrType;

/**
 * Csr controller.
 *
 */
class CsrController extends Controller
{
    /**
     * Lists all Csr entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $csrs = $em->getRepository('AppBundle:Csr')->findAll();

        return $this->render('csr/index.html.twig', array(
            'csrs' => $csrs,
        ));
    }

    /**
     * Creates a new Csr entity.
     *
     */
    public function newAction(Request $request)
    {
        $csr = new Csr();
        $form = $this->createForm('AppBundle\Form\CsrType', $csr);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($csr);
            $em->flush();

            return $this->redirectToRoute('csr_show', array('id' => $csr->getId()));
        }

        return $this->render('csr/new.html.twig', array(
            'csr' => $csr,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Csr entity.
     *
     */
    public function showAction(Csr $csr)
    {
        $deleteForm = $this->createDeleteForm($csr);

        return $this->render('csr/show.html.twig', array(
            'csr' => $csr,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Csr entity.
     *
     */
    public function editAction(Request $request, Csr $csr)
    {
        $deleteForm = $this->createDeleteForm($csr);
        $editForm = $this->createForm('AppBundle\Form\CsrType', $csr);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($csr);
            $em->flush();

            return $this->redirectToRoute('csr_edit', array('id' => $csr->getId()));
        }

        return $this->render('csr/edit.html.twig', array(
            'csr' => $csr,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Csr entity.
     *
     */
    public function deleteAction(Request $request, Csr $csr)
    {
        $form = $this->createDeleteForm($csr);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($csr);
            $em->flush();
        }

        return $this->redirectToRoute('csr_index');
    }

    /**
     * Creates a form to delete a Csr entity.
     *
     * @param Csr $csr The Csr entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Csr $csr)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('csr_delete', array('id' => $csr->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
