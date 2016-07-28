<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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

    /**
     * @Route("/exercice")
     * @Method({"GET"})
     */
    public function creerAction() 
    {
        $arianes = array(
            0 => [
                "libelle" => "Exercice",
                "lien" => "/exercice"         
            ]
        );
        return $this->render('AppBundle:exercice:create.html.twig', array('arianes' => $arianes));
    }

    /**
     * @Route("/exercice/{id}")
     * @Method({"GET"})
     */
    public function editAction() 
    {
             return $this->render('AppBundle:exercice:edit.html.twig');
    }

}
