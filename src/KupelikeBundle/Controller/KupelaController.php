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
            $this->crearCliente($em, $idCliente, $nombre);
            // añade un nuevo voto
            $this->nuevoVoto($em, $idCliente, $idKupela);
        }
        
        
        return new Response();
    }
    
    private function crearCliente($em, $id, $nombre)
    {
        // almacenamos en la tabla cliente
            $cliente = new Cliente();
            $cliente->setNombre($nombre);
            $cliente->setIdFacebook($id);
            
            
            $em->persist($cliente);
            $em->flush();
            
            return $cliente;
    }
    
    private function nuevoVoto($em, $idCliente, $idKupela)
    {
        $voto = new Voto();
        $voto->setClienteId($idCliente);
        $voto->setKupelaId($idKupela);
        $voto->setFecha(date('d/m/Y H:m'));
        
        $em->persist($voto);
        $em->flush();
    }
    
    public function extraerVotos(Request $request){
        
            $mostrarVotos = $this->getDoctrine()->getRepository('KupelikeBundle:Kupela')->find('id');
            
            if(!$mostrarVotos){
                throw $this->createNotFoundException('No se ha encontrado la kupepela con el ID'+$id);
            }
            
        }
        
    public function updateVotos($id)
    {
        $em = $this->getDoctrine()->getManager();
        $mostrarVotos = $em->getRepository('KupelikeBundle:Kupela')->find($id);
    
        if(!$mostrarVotos) {
            throw $this->createNotFoundException(
              'No se ha encontrado la kupepela con el ID'.$id
            );
        }
    
        $mostrarVotos->setName('');
        $em->flush();
    
        
    }
}
