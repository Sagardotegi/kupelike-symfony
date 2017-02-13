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
        
        /*$hombres = $em->createQuery(
            "SELECT k.id as id, count(v.id) as votos 
            FROM KupelikeBundle:Cliente c, KupelikeBundle:Voto v, KupelikeBundle:Kupela k
            WHERE c.sexo = 'male' AND v.clienteId = c.id AND k.idSagardotegi = :sagardotegi 
            GROUP BY k.id
            ")->setParameter('sagardotegi',$idSagardotegi)
                ->getResult();
                
            $mujeres = $em->createQuery(
            "SELECT k.id as id, count(v.id) as votos 
            FROM KupelikeBundle:Cliente c, KupelikeBundle:Voto v, KupelikeBundle:Kupela k
            WHERE c.sexo = 'female' AND v.clienteId = c.id AND k.idSagardotegi = :sagardotegi 
            GROUP BY k.id
        ")->setParameter('sagardotegi',$idSagardotegi)
                ->getResult();*/
        
        //$kupelaN = $em->getRepository('KupelikeBundle:Voto')->sumKupelas();
        
        return $this->render('KupelikeBundle:Kupela:index.html.twig', array(
            'kupelas' => $kupelas,
            'sagardotegi' => $sagardotegi/*,
            'hombres' =>$hombres, 
            'mujeres' =>$mujeres*/
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
    /*public function saveAction(Request $request)
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
    }*/
    
    /**
     * Crea una nueva sagardotegi con los datos obtenidos de Facebook
     */
    /*private function newSagardotegi($datos)
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
    }*/
    
    /**
     * Crea una nueva kupela con los datos obtenidos de Facebook
     */
    /*private function newKupela($datos)
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
    
    /**
     * Obtenemos las kupelas de una sagardotegi desde la API de Facebook
     * URL: /api/get-kupelas/{idPagina}
     */
    public function getKupelasAction($idPagina)
    {
        // Llamamos a la función que devuelve el objeto Facebook
        $fb = $this->facebookObject();
        
        // Creamos la solicitud
        $request = $fb->request(
            'GET', // Método
            $idPagina, // ID de la página de Facebook
            array('fields' => 'posts') // Campos que queremos obtener
        );
        
        // Obtenemos la respuesta
        $response = $fb->getClient()->sendRequest($request);
        $graphNode = $response->getGraphNode();
        
        // Devolvemos la respuesta
        return new Response($graphNode);
    }
    
    /**
     * Obtenemos el número de likes de una kupela
     * URL: /api/get-likes/{idKupela}
     */
    public function getLikesAction($idKupela)
    {
        $fb = $this->facebookObject();
        
        $request = $fb->request(
            'GET',
            $idKupela, 
            array('fields' => 'likes{username}')
        );
        
        $response = $fb->getClient()->sendRequest($request);
        $graphNode = $response->getGraphNode();
        
        // Añadimos a la respuesta la cuenta del número de likes
        $numLikes = 'num-likes: ' . count($graphNode['likes']) . '}';
        $json = json_decode($graphNode, true);
        array_push($json, $numLikes);
        $resJson = json_encode($json);
        
        return new Response($resJson);
    }
           
     public function getSagardotegiAction($nameSagardotegi)
    {    
         $fb = $this->facebookObject();
        $request = $fb->request(
            'GET',
           $nameSagardotegi, 
            array('fields' => 'name,picture.type(large),location,description,posts{id,full_picture,created_time,message}')
        );
        
        $response = $fb->getClient()->sendRequest($request);
        $graphNode = $response->getGraphNode();        
        return new Response($graphNode);
            
    }
    /**
     * Crea el objeto Facebook requerido para cada llamada a la API de Facebook
     */ 
    private function facebookObject()
    {
        // Obtiene los parámetros ID de la aplicación y Secret desde el archivo app/config/parameters.yml
        $faceID = $this->getParameter('facebook_id');
        $faceSecret = $this->getParameter('facebook_secret');
        
        // Creamos un nuevo objeto Facebook
        $fb = new Facebook([
          'app_id' => $faceID,
          'app_secret' => $faceSecret,
          'default_access_token' => $faceID . '|' . $faceSecret, // Utiliza un access token de aplicación - https://developers.facebook.com/docs/facebook-login/access-tokens#apptokens
          'default_graph_version' => 'v2.2',
          'http_client_handler' => 'stream',
          'cookie' => true
        ]);
        
        return $fb;
    }
}
