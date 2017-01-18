<?php

namespace KupelikeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use KupelikeBundle\Entity\Kupela;
use KupelikeBundle\Entity\Cliente;
use KupelikeBundle\Entity\Voto;

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
        //$idKupela = $datos['idKupela'];
        
        
        
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
        $voto = new Voto();
        $voto->setClienteId($idCliente);
        $voto->setKupelaId($idKupela);
        $voto->setFecha(date('Y/m/d'));
        
        $em->persist($voto);
        $em->flush();
        
        $this->updateVotos($idKupela);
    }
    
    public function extraerVotos(Request $request){
        
            $mostrarVotos = $this->getDoctrine()->getRepository('KupelikeBundle:Kupela')->find('id');
            
            if(!$mostrarVotos){
                throw $this->createNotFoundException('No se ha encontrado la kupela con el ID'+$id);
            }
            
        }
        
    public function updateVotos($id)
    {
        $em = $this->getDoctrine()->getManager();
        $kupelaVotos = $em->getRepository('KupelikeBundle:Kupela')->find($id);
        $votos = $kupelaVotos->getNumVotos();
        $nuevoVoto = $votos + 1;
    
        $kupelaVotos->setNumVotos($nuevoVoto);
        $em->flush();
        
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
}
