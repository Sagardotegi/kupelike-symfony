<?php

namespace KupelikeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use KupelikeBundle\Entity\Sagardotegi;
use KupelikeBundle\Entity\Kupela;
use Symfony\Component\HttpFoundation\Request;

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
    
    
    
    public function emailAction(Request $respuesta)
    {
        //cogemos los datos del formulario
        
        $nombre = $respuesta->request->get('nombre-apellidos');
        $email = $respuesta->request->get('emails');
        $contenido= $respuesta->request->get('contenido');
        
        $this->enviarEmail($nombre, $email, $contenido);
        return $this->render('KupelikeBundle:Index:contacto.html.twig');
    }

    private function enviarEmail($nombre, $email, $contenido){
        
         $mail = \Swift_Message::newInstance()
            ->setSubject('KupeLike - Contacto - ')
            ->setFrom($email)
            ->setTo('kupelikeproject@gmail.com')
            ->setBody('')
            ->addPart('<h3>Mensaje del cliente</h3> <br><p>' . $contenido . '</p>', 'text/html');
            
            $this->get('mailer')->send($mail);
        
    }
}

