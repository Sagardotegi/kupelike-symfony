<?php

namespace KupelikeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use KupelikeBundle\Entity\Kupela;
use KupelikeBundle\Entity\Cliente;
use KupelikeBundle\Entity\Voto;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

//use Lopi\Bundle\PusherBundle;
//use P2\Bundle\RatchetBundle\WebSocket\ConnectionEvent;
//use P2\Bundle\RatchetBundle\WebSocket\Payload;
//use P2\Bundle\RatchetBundle\WebSocket\Server\ApplicationInterface;

//require '/vendor/autoload.php';


class KupelaController extends Controller
{
    
    /**
     * Almacena un like en la kupela
     */
    public function likeAction($request)
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
        //$idKupela = $datos['idKupela'];
        //exec("php /web/pusher/pusher.php");
        
        
        
        
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
        
        //$this->hacerPusher();
        /*$pusher = $this->container->get('lopi_pusher.pusher');
        $data['message'] = "Cambiado";
        $pusher->trigger('my-channel', 'my-event', $data);*/
        
        
        
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
        $voto = new Voto();
        $voto->setClienteId($idCliente);
        $voto->setKupelaId($idKupela);
        $voto->setFecha(date('Y/m/d'));
        
        $em->persist($voto);
        $em->flush();
        
        $this->updateVotos($idKupela);
    }
    
    public function mostrarAction($id){
        
            $mostrarVotos = $this->getDoctrine()->getRepository('KupelikeBundle:Kupela')->find($id);
            if(!$mostrarVotos){
                throw $this->createNotFoundException('No se ha encontrado la kupela con el ID'+$id);
            }
            
            $mostrarVotos=json_encode($mostrarVotos);
            
         return new Response($mostrarVotos);

        }
 
    
    
    
        
    /*public function updateVotos($id)
    {
        $em = $this->getDoctrine()->getManager();
        $kupelaVotos = $em->getRepository('KupelikeBundle:Kupela')->find($id);
        $votos = $kupelaVotos->getNumVotos();
        $nuevoVoto = $votos + 1;
    
        $kupelaVotos->setNumVotos($nuevoVoto);
        $em->flush();
        //$this->hacerPusher($nuevoVoto);
        
        
        
        /*$em = $this->getDoctrine()->getManager();
        $mostrarVotos = $em->getRepository('KupelikeBundle:Kupela')->find($id);
    
        if(!$mostrarVotos) {
            throw $this->createNotFoundException(
              'No se ha encontrado la kupela con el ID'.$id
            );
        }
    
        $mostrarVotos->setName('');
        $em->flush();
    
        
    }*/
    
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
    
    //public function hacerPusherAction()
    //{
        /* pusher */
        //$pusher = $this->container->get('lopi_pusher.pusher');
        //$data['message'] = "Cambiado";
        //$pusher->trigger('my-channel', 'my-event', $data);
        
        //$pusher = $this->container->get('lopi_pusher.pusher');
        /*$options = array(
            'cluster' => 'eu',
            'encrypted' => true
        );
        $pusher = new Pusher(
            'fb3191e3b80fc4a2076b',
            'e557d927dbe92d8dd449',
            '291479',
            $options
        );*/
        //$data['message'] = "Cambiado";
        //$pusher->trigger('my-channel', 'my-event', $data);
        //return new Response();
        /* pusher */
        /*$em = $this->getDoctrine()->getManager();

        $sagardotegi = $em->getRepository('KupelikeBundle:Sagardotegi')->findOneBy(array("id" => $idSagardotegi));
        $kupelas = $em->getRepository('KupelikeBundle:Kupela')->findBy(array('idSagardotegi' => $idSagardotegi));
        
        return $this->render('KupelikeBundle:Kupela:index2.html.twig', array(
            'kupelas' => $kupelas,
            'sagardotegi' => $sagardotegi//,
            //'kupelaN' => $kupelaN
        ));*/
        //return new Response();
    //}
    /*public static function getSubscribedEvents()
    {
        return array(
            'votado' => 'onSendMessage'
        );
    }*/

    /*public function onSendMessage(MessageEvent $event)
    {*/
        //$client = $event->getConnection()->getClient()->jsonSerialize();
        //$message = $event->getPayload()->getData();

        /*$event->getConnection()->broadcast(
            new EventPayload(
                'chat.message',
                array(
                    'client' => $client,
                    'message' => $message
                )
            )
        );*/

        /*$event->getConnection()->emit(
            new EventPayload(
                'chat.message.sent',
                array(
                    'client' => $client,
                    'message' => $message
                )
            )
        );*/
        /*$message = $event->getPayload()->getData();
        
        $event->getConnection()->emit(
            new EventPayload(
                'voto',
                array(
                    'message' => $message
                )
            )
        );
    }*/
}
