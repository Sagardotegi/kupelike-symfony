<?php

namespace KupelikeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use KupelikeBundle\Entity\Sagardotegi;
use KupelikeBundle\Entity\Kupela;

class IndexController extends Controller
{
    public function indexAction()
    {
        // carga el Entity Manager (manejamos los datos con Doctrine (ORM))
        $em = $this->getDoctrine()->getManager();
        // obtiene todas las sagardotegis
        $sagardotegis = $em->getRepository('KupelikeBundle:Sagardotegi')->findAll();
        
        // renderiza la vista index de Sagardotegis y pasa la lista de sagardotegis como variable
        return $this->render('KupelikeBundle:Index:index.html.twig', array('sagardotegis' => $sagardotegis));
        //return $this->render('KupelikeBundle:Index:index.html.twig');
    }
    
    public function contactoAction()
    {
        return $this->render('KupelikeBundle:Index:contacto.html.twig');
    }
    
     public function nosotrosAction()
    {
        return $this->render('KupelikeBundle:Index:nosotros.html.twig');
    }
}