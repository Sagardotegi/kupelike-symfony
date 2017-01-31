<?php

namespace KupelikeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use KupelikeBundle\Entity\Kupela;
use KupelikeBundle\Entity\Cliente;
use KupelikeBundle\Entity\Voto;
use Lopi\Bundle\PusherBundle;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class KupelaController extends Controller
{
    
    /**
     * Almacena un like en la kupela
     */
    public function likeAction(Request $request)
    {
        // obtenemos los datos enviados por ajax
        $datos = $request->request->get('response');
        $idCliente = $datos['id'];
        $nombre = $datos['name'];
        $fbemail = $datos['email'];
        $fbgender = $datos['gender'];
        //$fblocation = $datos['location'];
        //$fblocation = $fblocation['name'];
        //$fbbirthday = $datos['birthday'];
        
        //$fbhometown = $datos['hometown'];
        //$fbagerange = $datos['age_range'];
        
        /*$idCliente = $datos->get('id');
        $nombre = $datos->get('name');
        $fbemail = $datos->getProperty('email');
        //$fbagerange = $datos->getProperty('age_range');
        $fbbirthday = $datos->getProperty('birthday')->format('Y-m-d');
        $fbgender = $datos->getProperty('gender');
        //$fbhometown = $datos->getProperty('hometown');
        $fblocation = $datos->getProperty('location');*/
        
        $idKupela = $request->request->get('idKupela');
        
        // Entity Manager
        $em = $this->getDoctrine()->getManager();
        // busca el id de facebook en la tabla Cliente
        $clienteExists = $em->getRepository('KupelikeBundle:Cliente')->find($idCliente);
        
        // si el id de facebook existe
        if($clienteExists){
            // añade un nuevo voto
            $this->nuevoVoto($em, $idCliente, $idKupela);
        } else {
            // crea un nuevo cliente
            //$this->crearCliente($em, $idCliente, $nombre, $fblocation, $fbemail, $fbbirthday, $fbgender);
            $this->crearCliente($em, $idCliente, $nombre, $fbemail, $fbgender);
            // añade un nuevo voto
            $this->nuevoVoto($em, $idCliente, $idKupela);
        }

        return new Response();
    }
    
    //private function crearCliente($em, $id, $nombre, $fblocation, $fbemail, $fbbirthday, $fbgender)
    private function crearCliente($em, $id, $nombre, $fbemail, $fbgender)
    {
        // almacenamos en la tabla cliente
            $cliente = new Cliente();
            $cliente->setNombre($nombre);
            $cliente->setId($id);
            $cliente->setEmail($fbemail);
            $cliente->setSexo($fbgender);
            //$cliente->setDireccion($fblocation);
            //$cliente->setFechaNacimiento($fbbirthday);
            
            
            $em->persist($cliente);
            $em->flush();
            
            //return $cliente;
    }
    
    private function nuevoVoto($em, $idCliente, $idKupela)
    {
        $votoExists = $em->getRepository('KupelikeBundle:Voto')->findOneBy(array('clienteId' => $idCliente, 'kupelaId' => $idKupela, 'fecha' => date('Y/m/d')));
        
        if(!$votoExists){
            $voto = new Voto();
            $voto->setClienteId($idCliente);
            $voto->setKupelaId($idKupela);
            $voto->setFecha(date('Y/m/d'));
            
            $em->persist($voto);
            $em->flush();
            
            $this->updateVotos($idKupela);
        }
    }
    
    public function mostrarAction($id){
        
            $mostrarVotos = $this->getDoctrine()->getRepository('KupelikeBundle:Kupela')->find($id);
            if(!$mostrarVotos){
                throw $this->createNotFoundException('No se ha encontrado la kupela con el ID'+$id);
            }
            
            $mostrarVotos=json_encode($mostrarVotos);
            
         return new Response($mostrarVotos);

        }
 
    
    
    
        
    public function updateVotos($id)
    {
        $em = $this->getDoctrine()->getManager();
        $kupelaVotos = $em->getRepository('KupelikeBundle:Kupela')->find($id);
        $votos = $kupelaVotos->getNumVotos();
        $nuevoVoto = $votos + 1;
    
        $kupelaVotos->setNumVotos($nuevoVoto);
        $em->flush();
        
        $this->hacerPusher($nuevoVoto, $id);
        
        
        
        /*$em = $this->getDoctrine()->getManager();
        $mostrarVotos = $em->getRepository('KupelikeBundle:Kupela')->find($id);
    
        if(!$mostrarVotos) {
            throw $this->createNotFoundException(
              'No se ha encontrado la kupela con el ID'.$id
            );
        }
    
        $mostrarVotos->setName('');
        $em->flush();*/
    
        
    }
    
    public function votosUsuarios(){
        
                
        $sql="SELECT COUNT(nick) from voto WHERE nick='".$_cookie[usuario]."'";
        $result=mysql_query($sql) or die (mysql_error());
         
        if (mysql_result($result,0) == 0){
        $sql="INSERT INTO voto (nick) VALUES ('".$_cookie[usuario]."')";
        mysql_query($sql);
         
        $up_votos = "UPDATE voto SET votos=votos+1 WHERE id=".$id;
        	mysql_query($up_votos);
         
         echo "Gracias por su voto.";
        } else {
         
         echo "Usted ya ha votado.";
        }
}
    public function hacerPusher($nuevoVoto, $id){
        $pusher = $this->container->get('lopi_pusher.pusher');
    
        $data['message'] = $nuevoVoto;
        $data['id'] = $id;
        $pusher->trigger('my-channel', 'my-event', $data);
    }
    
    /**
     * API REST
     */
     
     /**
      * Obtiene el número de likes de una kupela
      * /api/get-likes/{idKupela}
      */ 
    public function getLikesAction($idKupela)
    {
        $em = $this->getDoctrine()->getManager();
        $kupela = $em->getRepository('KupelikeBundle:Kupela')->find($idKupela);
        $numVotos = $kupela->getNumVotos();
        $votos = array('num-votos' => $numVotos);
        
        // Convertir el objeto en JSON
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        
        $serializer = new Serializer($normalizers, $encoders);
        
        // Devolvemos el objeto en JSON
        $json = $serializer->serialize($votos, 'json');
        return new Response($json);
    }
    
    public function addLikeAction($idKupela)
    {
        $em = $this->getDoctrine()->getManager();
        $kupela = $em->getRepository('KupelikeBundle:Kupela')->find($idKupela);
        
        // Encoders de JSON (para devolver JSON)
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        
        // si la kupela no existe
        if(!$kupela){
            $message = "La kupela no existe";
            
            $json = $serializer->serialize($message, 'json');
            return new Response($json);
        } else {
            $numVotos = $kupela->getNumVotos();
            $kupela->setNumVotos($numVotos + 1);
            $em->persist($kupela);
            $em->flush();
            
            $message = "Se ha agregado el voto correctamente";
            
            $json = $serializer->serialize($message, 'json');
            return new Response($json);
        }
        
    }
}
