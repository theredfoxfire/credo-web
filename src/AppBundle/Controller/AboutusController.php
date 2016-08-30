<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Aboutus;
use AppBundle\Entity\Aboutusimage;
use AppBundle\Form\AboutusType;

/**
 * Aboutus controller.
 *
 */
class AboutusController extends Controller
{
    /**
     * Lists all Aboutus entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $dql   = "SELECT a FROM AppBundle:Aboutus a";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        $aboutus = $em->getRepository('AppBundle:Aboutus')->findAll();
        $deleteForms = array();

        foreach ($aboutus as $entity) {
            $deleteForms[$entity->getId()] = $this->createDeleteForm($entity)->createView();
        }

        return $this->render('aboutus/index.html.twig', array(
            'pagination' => $pagination,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Aboutus entity.
     *
     */
    public function newAction(Request $request)
    {
        $aboutus = new Aboutus();
        $form = $this->createForm('AppBundle\Form\AboutusType', $aboutus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $file = $aboutus->getLargeImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('aboutus_directory'),
                $fileName
            );
            $aboutus->setLargeImage($fileName);
            $count = $request->request->get('aboutus')['fileCount'];
            for ($i = 1; $i <= $count; $i++) {
              $abimage = new Aboutusimage();
              $file =  $request->files->get('aboutus')['anotherImage'.$i];
              if (!empty($file)) {
                  $fileName = md5(uniqid()).'.'.$file->guessExtension();
                  $file->move(
                      $this->getParameter('aboutusimage_directory'),
                      $fileName
                  );
                  $abimage->setCreatedAt(new \DateTime());
                  $abimage->setLargeImage($fileName);
                  $abimage->setAboutus($aboutus);
                  $em->persist($abimage);
              }
            }
            $em->persist($aboutus);
            $em->flush();

            return $this->redirectToRoute('aboutus_index');
        }

        return $this->render('aboutus/new.html.twig', array(
            'aboutus' => $aboutus,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Aboutus entity.
     *
     */
    public function showAction(Aboutus $aboutus)
    {
        $deleteForm = $this->createDeleteForm($aboutus);

        return $this->render('aboutus/show.html.twig', array(
            'aboutus' => $aboutus,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Aboutus entity.
     *
     */
    public function editAction(Request $request, Aboutus $aboutus)
    {
        $deleteForm = $this->createDeleteForm($aboutus);
        $images = $aboutus->getAboutusImage();
        $editForm = $this->createForm('AppBundle\Form\AboutusType', $aboutus);
        $oldFile = $aboutus->getLargeImage();

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $count = $request->request->get('aboutus')['fileCount'];
            for ($i = 1; $i <= $count; $i++) {
              $abimage = new Aboutusimage();
              $file =  $request->files->get('aboutus')['anotherImage'.$i];
                if (!empty($file)) {
                    foreach ($images as $image) {
                        if (file_exists($this->getParameter('aboutusimage_directory').'/'.$image->getLargeImage()) && !empty($image->getLargeImage())) {
                            unlink($this->getParameter('aboutusimage_directory').'/'.$image->getLargeImage());
                            $em->remove($image);
                            $em->flush();
                        }
                    }
                    $fileName = md5(uniqid()).'.'.$file->guessExtension();
                    $file->move(
                        $this->getParameter('aboutusimage_directory'),
                        $fileName
                    );
                    $abimage->setCreatedAt(new \DateTime());
                    $abimage->setLargeImage($fileName);
                    $abimage->setAboutus($aboutus);
                    $em->persist($abimage);
                    $em->flush();
                }
            }
            if (file_exists($this->getParameter('aboutus_directory').'/'.$oldFile) && !empty($aboutus->getLargeImage())) {
                unlink($this->getParameter('aboutus_directory').'/'.$oldFile);
                $file = $aboutus->getLargeImage();
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move(
                    $this->getParameter('aboutus_directory'),
                    $fileName
                );
                $aboutus->setLargeImage($fileName);
            } else {
              $aboutus->setLargeImage($oldFile);
            }
            $em->persist($aboutus);
            $em->flush();

            return $this->redirectToRoute('aboutus_index');
        }

        return $this->render('aboutus/edit.html.twig', array(
            'aboutus' => $aboutus,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Aboutus entity.
     *
     */
    public function deleteAction(Request $request, Aboutus $aboutus)
    {
        $form = $this->createDeleteForm($aboutus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($aboutus);
            $em->flush();
        }

        return $this->redirectToRoute('aboutus_index');
    }

    /**
     * Creates a form to delete a Aboutus entity.
     *
     * @param Aboutus $aboutus The Aboutus entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Aboutus $aboutus)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('aboutus_delete', array('id' => $aboutus->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
