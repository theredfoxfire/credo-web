<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Branches;
use AppBundle\Form\BranchesType;

/**
 * Branches controller.
 *
 */
class BranchesController extends Controller
{
    /**
     * Lists all Branches entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $branches = $em->getRepository('AppBundle:Branches')->findAll();

        return $this->render('branches/index.html.twig', array(
            'branches' => $branches,
        ));
    }

    /**
     * Creates a new Branches entity.
     *
     */
    public function newAction(Request $request)
    {
        $branch = new Branches();
        $form = $this->createForm('AppBundle\Form\BranchesType', $branch);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($branch);
            $em->flush();

            return $this->redirectToRoute('branches_show', array('id' => $branch->getId()));
        }

        return $this->render('branches/new.html.twig', array(
            'branch' => $branch,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Branches entity.
     *
     */
    public function showAction(Branches $branch)
    {
        $deleteForm = $this->createDeleteForm($branch);

        return $this->render('branches/show.html.twig', array(
            'branch' => $branch,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Branches entity.
     *
     */
    public function editAction(Request $request, Branches $branch)
    {
        $deleteForm = $this->createDeleteForm($branch);
        $editForm = $this->createForm('AppBundle\Form\BranchesType', $branch);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($branch);
            $em->flush();

            return $this->redirectToRoute('branches_edit', array('id' => $branch->getId()));
        }

        return $this->render('branches/edit.html.twig', array(
            'branch' => $branch,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Branches entity.
     *
     */
    public function deleteAction(Request $request, Branches $branch)
    {
        $form = $this->createDeleteForm($branch);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($branch);
            $em->flush();
        }

        return $this->redirectToRoute('branches_index');
    }

    /**
     * Creates a form to delete a Branches entity.
     *
     * @param Branches $branch The Branches entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Branches $branch)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('branches_delete', array('id' => $branch->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
