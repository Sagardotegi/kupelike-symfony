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
        $id = $request->request->get('id');
        $nombre = $request->request->get('name');
        $birthday = $request->request->get('birthday');
        $email = $request->request->get('email');
        
        // Entity Manager
        $em = $this->getDoctrine()->getManager();
        // busca el id de facebook en la tabla Cliente
        $idFacebook = $em->getRepository('KupelikeBundle:Cliente')->findBy(array('idFacebook' => $id));
        
        // si el id de facebook no existe
        if($idFacebook != $id){
            // crea un nuevo cliente
            crearCliente($id, $nombre, $birthday, $email);
            // incrementa en uno el número de votos de la kupela
            incrementarVoto($cliente, $kupela);
        } else {
            // incrementa en uno el número de votos de la kupela
            
        }
        
        
        return new Response();
    }
    
    private function crearCliente($id, $nombre, $birthday, $email)
    {
        // almacenamos en la tabla cliente
            $cliente = new Cliente();
            $cliente->setFechaNacimiento($birthday);
            $cliente->setNombre($nombre);
            $cliente->setEmail($email);
            $cliente->setIdFacebook($id);
            
            
            $em->persist($cliente);
            $em->flush();
            
            return $cliente;
    }
    
}
