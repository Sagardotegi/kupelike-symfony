<?php

namespace KupelikeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use KupelikeBundle\Entity\Sagardotegi;
use KupelikeBundle\Entity\Kupela;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

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
     * Muestra la lista de sagardotegis para Index limitado a X
     **/
    public function listaIndexAction()
    {
        // carga el Entity Manager (manejamos los datos con Doctrine (ORM))
        $em = $this->getDoctrine()->getManager();
        // obtiene todas las sagardotegis
        $sagardotegis = $em->getRepository('KupelikeBundle:Sagardotegi')->find(6);
        
        // renderiza la vista index de Sagardotegis y pasa la lista de sagardotegis como variable
        return $this->render('KupelikeBundle:Sagardotegi:listaIndex.html.twig', array('sagardotegis' => $sagardotegis));
    }
    
    /**
     * Muestra una sagardotegi y sus kupelas
     */
    public function viewAction($idSagardotegi){
        // carga el Entity Manager (manejamos los datos con Doctrine (ORM))
        $em = $this->getDoctrine()->getManager();
        // obtenemos la sagardotegi que queremos visualizar
        $sagardotegi = $em->getRepository('KupelikeBundle:Sagardotegi')->findOneBy(array("id" => $idSagardotegi));
        
        // obtenemos las kupelas de la sagardotegi
        $kupelas = $em->getRepository('KupelikeBundle:Kupela')->findBy(array('idSagardotegi' => $idSagardotegi),['nombre' => 'ASC']);

        if(!empty($kupelas)) {
            $mujeres = $this->getNumMujeres($em);
            $hombres = $this->getNumHombres($em);
            $fechas = $this->getNumXfecha($em);
        }

        if(empty($kupelas)) {
            return $this->render('KupelikeBundle:Kupela:index.html.twig', array(
                'kupelas' => $kupelas,
                'sagardotegi' => $sagardotegi
            ));
        } else {
            return $this->render('KupelikeBundle:Kupela:index.html.twig', array(
                'kupelas' => $kupelas,
                'sagardotegi' => $sagardotegi,
                'hombres' =>$hombres, 
                'mujeres' =>$mujeres,
                'fechas' =>$fechas
            ));
        }
        
        
    }
    
    /**
     * Para ver qué nos devuelven las consultas
     */ 
    public function devolversexoAction($idKupela)
    {
        $em = $this->getDoctrine()->getManager();
        return new JsonResponse($this->getNumMujeres($em));
    }
    
    private function getNumHombres($em)
    {
        $query = $em->createQuery(
            "SELECT count(v.id) as hombres, k.id as id
            FROM KupelikeBundle:Cliente c, KupelikeBundle:Kupela k, KupelikeBundle:Voto v
            WHERE c.sexo = 'male' 
            AND v.clienteId = c.id 
            AND v.kupelaId = k.id
            GROUP BY k.id
            ORDER BY k.id");
            
        return $query->getResult(); 
    }
    
    private function getNumMujeres($em)
    {
        $query = $em->createQuery(
            "SELECT count(v.id) as mujeres, k.id as id
            FROM KupelikeBundle:Cliente c, KupelikeBundle:Kupela k, KupelikeBundle:Voto v
            WHERE c.sexo = 'female' 
            AND v.clienteId = c.id 
            AND v.kupelaId = k.id
            GROUP BY k.id");
        
        return $query->getResult();    
    }
    
    private function getNumXfecha($em)
    {        
        $query = $em->createQuery(
            "SELECT v.fecha as fecha, count(v.id) as NumVotos, k.id as id
            FROM KupelikeBundle:Voto v, KupelikeBundle:Kupela k 
            WHERE k.id=v.kupelaId 
            GROUP BY k.id, v.fecha
            ORDER BY v.fecha");
        return $query->getResult(); 
    }
    
    /**
     * Muestra el mapa con la locaclización de la sagardotegi
     */
    public function mapaAction($idSagardotegi)
    {
        // carga el Entity Manager (manejamos los datos con Doctrine (ORM))
        $em = $this->getDoctrine()->getManager();
        // obtenemos la sagardotegi que queremos visualizar
        $sagardotegi = $em->getRepository('KupelikeBundle:Sagardotegi')->findOneBy(array('id' => $idSagardotegi));
        
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
        
        return $this->render('KupelikeBundle:Index:gps.html.twig', array('sagardotegis' => $sagardotegis));
    }
    
    /**
     * Obtiene las sagardotegis y sus kupelas de las páginas de Facebook con una llamada a la API desde JavaScript y las almacena en la BD
     */
    public function saveAction(Request $request)
    {
        // obtenemos los datos de la sagardotegi enviados por ajax
        $nombre = $request->query->get('name');
        $idSagardotegiFacebook = $request->query->get('id');
        
        $foto = $request->query->get('picture');
        $foto = $foto['data']['url'];
        
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
            $this->newSagardotegi($datos);
        }
        
        $posts = $request->query->get('posts');
        
        // comprueba las kupelas (posts)
        foreach($posts['data'] as $kupela){
            $idKupelaFacebook = $kupela['id'];
            $message = $kupela['message'];
            // separamos el atributo message en dos, para que la primera palabra sea el titulo
            $message = explode("/", $message);
            $nombre = $message[0];
            $descripcion = $message[1];
            $year = $kupela['created_time'];
            $foto = $kupela['full_picture'];
            // la primera parte del id de la kupela es igual al id de la sagardotegi, lo separamos
            $idSagardotegiFacebook = explode("_", $idKupelaFacebook);
            $idSagardotegiFacebook = $idSagardotegiFacebook[0];
            
            // Entity Manager
            $em = $this->getDoctrine()->getManager();
            $data = [$idKupelaFacebook, $nombre, $year, $foto, $idSagardotegiFacebook, $descripcion];
            // busca si existe la kupela
            $kupelaExists = $em->getRepository('KupelikeBundle:Kupela')->findOneBy(array('idKupelaFacebook' => $idKupelaFacebook));
            
            if(!$kupelaExists){
                $this->newKupela($data);
            }
        }
        return new Response();
    }
    
    /**
     * Crea una nueva sagardotegi con los datos obtenidos de Facebook
     */
    private function newSagardotegi($datos)
    {
        $em = $this->getDoctrine()->getManager();
        // creamos la sagardotegi
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
    
    /**
     * Crea una nueva kupela con los datos obtenidos de Facebook
     */
    private function newKupela($datos)
    {
        $em = $this->getDoctrine()->getManager();
        
        $kupela = new Kupela();
        $kupela->setIdKupelaFacebook($datos[0]);
        $kupela->setNombre($datos[1]);
        $kupela->setYear($datos[2]);
        $kupela->setFoto($datos[3]);
        $kupela->setIdSagardotegi($datos[4]);
        $kupela->setDescripcion($datos[5]);
        
        $em->persist($kupela);
        $em->flush();
        
        return $kupela;
    }
    
    /**
     * REST API
     */
    
    public function getSagardotegiAction($idSagardotegi)
    {
        $em = $this->getDoctrine()->getManager();
        $sagardotegi = $em->getRepository('KupelikeBundle:Sagardotegi')->find($idSagardotegi);
        $nombre = $sagardotegi->getNombre();
        $direccion = $sagardotegi->getDireccion();
        $descripcion = $sagardotegi->getDescripcion();
        $latitud = $sagardotegi->getLatitud();
        $longitud = $sagardotegi->getLongitud();
        $horario = $sagardotegi->getHorario();
        $telefono = $sagardotegi->getTelefono();
        $email = $sagardotegi->getEmail();
        $foto = $sagardotegi->getFoto();
        
        $kupela = $em->getRepository('KupelikeBundle:Kupela')->findBy(array('idSagardotegi' => $idSagardotegi),['nombre' => 'ASC']);
        foreach ($kupela as $kupel) {
            $kupelas[] = array(
                'Nombre' => $kupel->getNombre(),
                'Foto' => $kupel->getFoto(),
                'Votos' => $kupel->getNumVotos(),
                'Año' => $kupel->getYear(),
                'Descripción' => $kupel->getDescripcion(),
            );
        }

        $response = new JsonResponse();
        $response->setData(array(
            'Nombre' => $nombre,
            'Foto' => $foto,
            'Descripcion' => $descripcion,
            'Horario' => $horario,
            'Direccion' => $direccion,
            'Contacto' => array(
                'Telefono' => $telefono,
                'Email' => $email
            ),
            'Coordenadas' => array(
                'Latitud' => $latitud,
                'Longitud' => $longitud
            ),
            'Kupelas' => $kupelas
        ));
        return $response;
    }

}