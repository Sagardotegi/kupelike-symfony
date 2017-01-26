<?php

namespace KupelikeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    
    /**
     * Pagina de administracion sidreros
     */
     
     
     
     
    /**
     * Muestra la sagardotegi del usuario y sus kupelas
     */
     
    public function AdminAction($idAdmin)
    {
        // carga el Entity Manager (manejamos los datos con Doctrine (ORM))
        $em = $this->getDoctrine()->getManager();
        // obtenemos la sagardotegi que queremos visualizar
        $sagardotegi = $em->getRepository('KupelikeBundle:Sagardotegi')->find($idSagardotegi);
        // obtenemos los datos para la busqueda de sagardotegis
        //$sagardotegis = $em->getRepository('KupelikeBundle:Sagardotegi')->findAll();
        // obtenemos las kupelas de la sagardotegi
        $kupelas = $em->getRepository('KupelikeBundle:Kupela')->findBy(array('idSagardotegi' => $idSagardotegi));
        
        return $this->render('KupelikeBundle:Kupela:index2.html.twig', array(
            'kupelas' => $kupelas,
            'sagardotegi' => $sagardotegi
        ));
        
    }
}
?>