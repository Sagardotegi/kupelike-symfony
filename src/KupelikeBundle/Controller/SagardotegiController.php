<?php

namespace KupelikeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use KupelikeBundle\Entity\Sagardotegi;
use KupelikeBundle\Entity\Kupela;

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
    
    /**
     * Muestra una sagardotegi y sus kupelas
     */
    public function viewAction($idSagardotegi)
    {
        // carga el Entity Manager (manejamos los datos con Doctrine (ORM))
        $em = $this->getDoctrine()->getManager();
        // obtenemos la sagardotegi que queremos visualizar
        $sagardotegi = $em->getRepository('KupelikeBundle:Sagardotegi')->find($idSagardotegi);
        // obtenemos las kupelas de la sagardotegi
        $kupelas = $em->getRepository('KupelikeBundle:Kupela')->findBy(array('idSagardotegi' => $idSagardotegi));
        
        return $this->render('KupelikeBundle:Kupela:index.html.twig', array(
            'kupelas' => $kupelas,
            'sagardotegi' => $sagardotegi
        ));
    }
    
    /**
     * Muestra el mapa con la locaclización de la sagardotegi
     */
    public function mapaAction($idSagardotegi)
    {
        // carga el Entity Manager (manejamos los datos con Doctrine (ORM))
        $em = $this->getDoctrine()->getManager();
        // obtenemos la sagardotegi que queremos visualizar
        $sagardotegi = $em->getRepository('KupelikeBundle:Sagardotegi')->find($idSagardotegi);
        
        return $this->render('KupelikeBundle:Sagardotegi:mapaSagar.html.twig', array('sagardotegi' => $sagardotegi));
    }
    
    /**
     * Muestra el mapa con la locaclización de todas las sagardotegis
     */
    public function mapakAction()
    {
        // carga el Entity Manager (manejamos los datos con Doctrine (ORM))
        $em = $this->getDoctrine()->getManager();
        // obtenemos la sagardotegi que queremos visualizar
        $sagardotegis = $em->getRepository('KupelikeBundle:Sagardotegi')->findAll();
        
        return $this->render('KupelikeBundle:Sagardotegi:mapaDenak.html.twig', array('sagardotegis' => $sagardotegis));
    }
}
