<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Slide;
use AppBundle\Entity\Logo;
use AppBundle\Entity\Quote;

class DefaultController extends Controller
{
    /**
     * @Route("/admin", name="adminHomepage")
     */
    public function adminAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/indexAdmin.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }
    /**
     * @Route("/", name="homepage")
     */
     public function indexAction(Request $request)
     {
         $em = $this->getDoctrine()->getManager();

         $slides = $em->getRepository('AppBundle:Slide')->findAll();
         $logos = $em->getRepository('AppBundle:Logo')->findAll();
         $quotes = $em->getRepository('AppBundle:Quote')->findAll();
         $abouts = $em->getRepository('AppBundle:Aboutus')->findAll();

         return $this->render('default/index.html.twig', array(
             'slides' => $slides,
             'logos' => $logos,
             'quotes' => $quotes,
             'abouts' => $abouts,
         ));
     }
}
