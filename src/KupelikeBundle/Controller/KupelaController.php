<?php

namespace KupelikeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use KupelikeBundle\Entity\Kupela;
use KupelikeBundle\Entity\Cliente;

class KupelaController extends Controller
{
    /**
     * Inserta un objeto en la tabla 'Kupela'
     */ 
    public function newAction()
    {
        
    }
    
    /**
     * Almacena un like en la kupela
     */
    public function likeAction(Request $request)
    {
        // obtenemos los datos enviados por ajax
        $nombre = $request->request->get('name');
        $birthday = $request->request->get('birthday');
        $email = $request->request->get('email');
        
        // Entity Manager
        $em = $this->getDoctrine()->getManager();
        $emailCliente = $em->getRepository('KupelikeBundle:Cliente')->find($email);
        
        // si el email no existe almacena el usuario
        if(!$emailCliente){
        
            // almacenamos en la tabla cliente
            $cliente = new Cliente();
            $cliente->setFechaNacimiento($birthday);
            $cliente->setNombre($nombre);
            $cliente->setEmail($email);
            
            
            $em->persist($cliente);
            $em->flush();
        }
        
        
        return new Response("Kaixo");
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
    
}
