<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Unites;
use AppBundle\Form\UnitesType;

/**
 * Unites controller.
 *
 */
class UnitesController extends Controller
{
    /**
     * Lists all Unites entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $unites = $em->getRepository('AppBundle:Unites')->findAll();
        $deleteForms = array();

        foreach ($unites as $entity) {
            $deleteForms[$entity->getId()] = $this->createDeleteForm($entity)->createView();
        }

        return $this->render('unites/index.html.twig', array(
            'unites' => $unites,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Unites entity.
     *
     */
    public function newAction(Request $request)
    {
        $unite = new Unites();
        $form = $this->createForm('AppBundle\Form\UnitesType', $unite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $unite->getLargeImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('unites_directory'),
                $fileName
            );
            $unite->setLargeImage($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($unite);
            $em->flush();

            return $this->redirectToRoute('unites_show', array('id' => $unite->getId()));
        }

        return $this->render('unites/new.html.twig', array(
            'unite' => $unite,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Unites entity.
     *
     */
    public function showAction(Unites $unite)
    {
        $deleteForm = $this->createDeleteForm($unite);

        return $this->render('unites/show.html.twig', array(
            'unite' => $unite,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Unites entity.
     *
     */
    public function editAction(Request $request, Unites $unite)
    {
        $deleteForm = $this->createDeleteForm($unite);
        $editForm = $this->createForm('AppBundle\Form\UnitesType', $unite);
        $oldFile = $unite->getLargeImage();

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if (file_exists($this->getParameter('unites_directory').'/'.$oldFile)) {
                unlink($this->getParameter('unites_directory').'/'.$oldFile);
            }
            $file = $unite->getLargeImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('unites_directory'),
                $fileName
            );
            $unite->setLargeImage($fileName);
            $em->persist($unite);
            $em->flush();

            return $this->redirectToRoute('unites_edit', array('id' => $unite->getId()));
        }

        return $this->render('unites/edit.html.twig', array(
            'unite' => $unite,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Unites entity.
     *
     */
    public function deleteAction(Request $request, Unites $unite)
    {
        $form = $this->createDeleteForm($unite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if (file_exists($this->getParameter('unites_directory').'/'.$unite->getLargeImage())) {
                unlink($this->getParameter('unites_directory').'/'.$unite->getLargeImage());
            }
            $em->remove($unite);
            $em->flush();
        }

        return $this->redirectToRoute('unites_index');
    }

    /**
     * Creates a form to delete a Unites entity.
     *
     * @param Unites $unite The Unites entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Unites $unite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('unites_delete', array('id' => $unite->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
