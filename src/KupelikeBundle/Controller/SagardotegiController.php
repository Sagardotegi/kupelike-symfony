<?php

namespace KupelikeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use KupelikeBundle\Entity\Sagardotegi;
use KupelikeBundle\Entity\Kupela;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

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
        // obtenemos los datos para la busqueda de sagardotegis
        //$sagardotegis = $em->getRepository('KupelikeBundle:Sagardotegi')->findAll();
        // obtenemos las kupelas de la sagardotegi
        $kupelas = $em->getRepository('KupelikeBundle:Kupela')->findBy(array('idSagardotegi' => $idSagardotegi));
        
        return $this->render('KupelikeBundle:Kupela:index2.html.twig', array(
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
    
    /**
     * Redirecciona con la locaclización de la persona y todas las sagardotegis
     */
    public function gpsAction()
    {
        // carga el Entity Manager (manejamos los datos con Doctrine (ORM))
        $em = $this->getDoctrine()->getManager();
        // obtenemos la sagardotegi que queremos visualizar
        $sagardotegis = $em->getRepository('KupelikeBundle:Sagardotegi')->findAll();
        
        return $this->render('KupelikeBundle:Sagardotegi:gps.html.twig', array('sagardotegis' => $sagardotegis));
    }
    
    /**
     * Obtiene las sagardotegis de las páginas de Facebook con una llamada a la API desde JavaScript y las almacena en la BD
     */
    public function saveAction(Request $request)
    {
        // obtenemos los datos enviados por ajax
        $nombre = $request->query->get('name');
        $idSagardotegiFacebook = $request->query->get('id');
        $objPicture = $request->query->get('picture');
        $foto = $objPicture['data']['url'];
        $location = $request->query->get('location');
        $direccion = $location['street'];
        $latitud = $location['latitude'];
        $longitud = $location['longitude'];
        $descripcion = $request->query->get('description');
        
        // pasamos los datos a un array
        $datos = [$nombre, $idSagardotegiFacebook, $foto, $direccion, $latitud, $longitud, $descripcion];
        
        // Entity Manager
        $em = $this->getDoctrine()->getManager();
        // busca si existe alguna sagardotegi con el ID de Facebook
        $sagardotegiExists = $em->getRepository('KupelikeBundle:Sagardotegi')->findOneBy(array('idSagardotegiFacebook' => $idSagardotegiFacebook));
        
        if(!$sagardotegiExists){
            // crea una nueva sagardotegi si no existe
            $this->newSagardotegi($em, $datos);
        }
        
        return new Response();
    }
    
    /**
     * Crea una nueva sagardotegi con los datos obtenidos de Facebook
     */
    private function newSagardotegi($em, $datos)
    {
        $sagardotegi = new Sagardotegi();
        $sagardotegi->setNombre($datos[0]);
        $sagardotegi->setIdSagardotegiFacebook($datos[1]);
        $sagardotegi->setFoto($datos[2]);
        $sagardotegi->setDireccion($datos[3]);
        $sagardotegi->setLatitud($datos[4]);
        $sagardotegi->setLongitud($datos[5]);
        $sagardotegi->setDescripcion($datos[6]);
        
        $em->persist($sagardotegi);
        $em->flush();
        
        return $sagardotegi;
    }
}
