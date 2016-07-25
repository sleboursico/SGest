<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ExercicesController extends Controller {

    /**
     * @Route("/")
     */
    public function indexAction() 
    {
        
        if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
             return $this->render('AppBundle:exercice:dashboard.html.twig');
        }
        return $this->render('AppBundle:Default:index.html.twig');
    }

}
