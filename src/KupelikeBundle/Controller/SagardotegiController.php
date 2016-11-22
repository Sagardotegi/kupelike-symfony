<?php

namespace KupelikeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use KupelikeBundle\Entity\Sagardotegi;

class SagardotegiController extends Controller
{
    /**
     * Muestra la lista de sagardotegis
     **/
    public function listaAction()
    {
        // carga el Entity Manager (manejamos los datos con Doctrine (ORM))
        $em = $this->getDoctrine()->getManager();
        // obtiene todas las sagardotegis
        $sagardotegis = $em->getRepository('KupelikeBundle:Sagardotegi')->findAll();
        
        // renderiza la vista index de Sagardotegis y pasa la lista de sagardotegis como variable
        return $this->render('KupelikeBundle:Sagardotegi:index.html.twig', array('sagardotegis' => $sagardotegis));
    }
}
