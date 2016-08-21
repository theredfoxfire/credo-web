<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\News;
use AppBundle\Form\NewsType;

/**
 * News controller.
 *
 */
class NewsController extends Controller
{
    /**
     * Lists all News entities.
     *
     */
     public function indexAction(Request $request)
     {
         $em = $this->getDoctrine()->getManager();
         $dql   = "SELECT a FROM AppBundle:News a";
         $query = $em->createQuery($dql);

         $paginator  = $this->get('knp_paginator');
         $pagination = $paginator->paginate(
             $query, /* query NOT result */
             $request->query->getInt('page', 1)/*page number*/,
             10/*limit per page*/
         );

         $news = $em->getRepository('AppBundle:News')->findAll();
         $deleteForms = array();

         foreach ($news as $entity) {
             $deleteForms[$entity->getId()] = $this->createDeleteForm($entity)->createView();
         }

         return $this->render('news/index.html.twig', array(
             'pagination' => $pagination,
             'deleteForms' => $deleteForms,
         ));
     }

    /**
     * Creates a new News entity.
     *
     */
    public function newAction(Request $request)
    {
        $news = new News();
        $form = $this->createForm('AppBundle\Form\NewsType', $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $file = $news->getLargeImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('news_directory'),
                $fileName
            );
            $news->setLargeImage($fileName);
            $news->setDateTime(new \DateTime());
            $news->setPostedBy($this->getUser()->getUsername());
            $em->persist($news);
            $em->flush();

            return $this->redirectToRoute('news_show', array('id' => $news->getId()));
        }

        return $this->render('news/new.html.twig', array(
            'news' => $news,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a News entity.
     *
     */
    public function showAction(News $news)
    {
        $deleteForm = $this->createDeleteForm($news);

        return $this->render('news/show.html.twig', array(
            'news' => $news,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Finds and displays a News entity.
     *
     */
    public function showPublicAction(News $news)
    {
        $deleteForm = $this->createDeleteForm($news);

        return $this->render('news/showPublic.html.twig', array(
            'news' => $news,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing News entity.
     *
     */
    public function editAction(Request $request, News $news)
    {
        $deleteForm = $this->createDeleteForm($news);
        $editForm = $this->createForm('AppBundle\Form\NewsType', $news);
        $oldFile = $news->getLargeImage();
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $file = $news->getLargeImage();
            if (!empty($file)) {
                if (file_exists($this->getParameter('news_directory').'/'.$oldFile)) {
                    unlink($this->getParameter('news_directory').'/'.$oldFile);
                }
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move(
                    $this->getParameter('news_directory'),
                    $fileName
                );
                $news->setLargeImage($fileName);
            }

            $em->persist($news);
            $em->flush();

            return $this->redirectToRoute('news_edit', array('id' => $news->getId()));
        }

        return $this->render('news/edit.html.twig', array(
            'news' => $news,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a News entity.
     *
     */
    public function deleteAction(Request $request, News $news)
    {
        $form = $this->createDeleteForm($news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if (file_exists($this->getParameter('news_directory').'/'.$news->getLargeImage())) {
                unlink($this->getParameter('news_directory').'/'.$news->getLargeImage());
            }
            $em->remove($news);
            $em->flush();
        }

        return $this->redirectToRoute('news_index');
    }

    /**
     * Creates a form to delete a News entity.
     *
     * @param News $news The News entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(News $news)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('news_delete', array('id' => $news->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
