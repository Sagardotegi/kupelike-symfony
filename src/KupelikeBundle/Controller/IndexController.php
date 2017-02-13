<?php

namespace KupelikeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use KupelikeBundle\Entity\Sagardotegi;
use KupelikeBundle\Entity\Kupela;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Response;


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
    }
    
    public function contactoAction()
    {
        // carga el Entity Manager (manejamos los datos con Doctrine (ORM))
        //$em = $this->getDoctrine()->getManager();
        // obtenemos los datos para la busqueda de sagardotegis
        //$sagardotegis = $em->getRepository('KupelikeBundle:Sagardotegi')->findAll();
        return $this->render('KupelikeBundle:Index:contacto.html.twig');
    }
    
    public function nosotrosAction()
    {
        // carga el Entity Manager (manejamos los datos con Doctrine (ORM))
        //$em = $this->getDoctrine()->getManager();
        // obtenemos los datos para la busqueda de sagardotegis
        //$sagardotegis = $em->getRepository('KupelikeBundle:Sagardotegi')->findAll();
        return $this->render('KupelikeBundle:Index:nosotros.html.twig');
    }
    
    /*
    public function loginAction()
    {
        return $this->render('KupelikeBundle:Index:login.html.twig');
    }
    
    public function accederAction(Request $request)
    {
        // carga el Entity Manager (manejamos los datos con Doctrine (ORM))
        $em = $this->getDoctrine()->getManager();
        // obtiene todas las sagardotegis
        $sagardotegis = $em->getRepository('KupelikeBundle:Sagardotegi')->findAll();
        
        //cogemos los datos del formulario
        
        $username = $respuesta->request->get('username');
        $password = $respuesta->request->get('password');
        
        /*$this->enviarEmail($nombre, $email, $contenido);
        return $this->render('KupelikeBundle:Index:contacto.html.twig', array(
            'sagardotegis' => $sagardotegis
        ));
        return $this->render('KupelikeBundle:Index:portal.html.twig');
    }*/
    
    public function searchAction(Request $request)
    {
        $string = $request->request->get('textoBusqueda');
        $sagardotegis = $this->getDoctrine()
                     ->getRepository('KupelikeBundle:Sagardotegi')
                     ->findByLetters($string);
                     
        // Devuelve los resultados en formato JSON
        $encoders = array(new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize($sagardotegis, 'json');
        $response = new Response($jsonContent);
        return $response;
    }
    
    public function emailAction(Request $respuesta)
    {
        
        // carga el Entity Manager (manejamos los datos con Doctrine (ORM))
        $em = $this->getDoctrine()->getManager();
        // obtiene todas las sagardotegis
        $sagardotegis = $em->getRepository('KupelikeBundle:Sagardotegi')->findAll();
        
        //cogemos los datos del formulario
        
        $nombre = $respuesta->request->get('nombre-apellidos');
        $email = $respuesta->request->get('email');
        $contenido= $respuesta->request->get('contenido');
        
        $this->enviarEmail($nombre, $email, $contenido);
        return $this->render('KupelikeBundle:Index:contacto.html.twig', array(
            'sagardotegis' => $sagardotegis
        ));
    }

    private function enviarEmail($nombre, $email, $contenido){
        
         $mail = \Swift_Message::newInstance()
            ->setSubject('KupeLike - Contacto - '.$email)
            ->setFrom("kupelikeproject@gmail.com")
            ->setTo('kupelikeproject@gmail.com')
            ->setBody('')
            ->addPart('<h1>Nombre Cliente</h1>'
                .$nombre.
                '<h2>Mensaje del cliente</h2>
                <p>' . $contenido . '</p>
                <h2>Email Cliente</h2>
                </br>' .$email, 'text/html');
            
            $this->get('mailer')->send($mail);
        
    }
     public function registrarAction(Request $registro)
    {
        
        //cogemos los datos del formulario
        
        $nombre = $registro->request->get('nombre-apellidos');
        $email = $registro->request->get('email');
        $nombreSidreria= $registro->request->get('nombreSidreria');
        $direccion= $registro->request->get('direccion');
        $descripcion= $registro->request->get('descripcion');

        $this->registroEmail($nombre, $email, $nombreSidreria,$direccion,$descripcion);
        return $this->render('KupelikeBundle:Index:registro_sidrerias.html.twig');
        
    }
    
    private function registroEmail($nombre, $email, $nombreSidreria,$direccion,$descripcion){
        
         $mail = \Swift_Message::newInstance()
            ->setSubject('KupeLike - Registro - '.$email)
            ->setFrom("kupelikeproject@gmail.com")
            ->setTo('kupelikeproject@gmail.com')
            ->setBody('')
            ->addPart('<h1>Nombre Cliente</h1>'
                .$nombre.
                '<h1>Datos de la sidreria</h1>
                <h2> Nombre sidreria:</h2><p>'.$nombreSidreria.'</p>
                <h2>Direccion</h2>
                <p>'.$direccion.'</p>
                <h2>Descrpcion sidreria</h2>
                <p>' . $descripcion . '</p>
                </br><h2>Email de contacto sidrero:</h2>' .$email, 'text/html');
            
            $this->get('mailer')->send($mail);
        
    }
    
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();
        
        return $this->render('KupelikeBundle:Security:login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }
    
    
}

