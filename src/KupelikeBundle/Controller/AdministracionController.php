<?php

namespace KupelikeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use KupelikeBundle\Entity\Usuario;
use KupelikeBundle\Entity\Sagardotegi;
use KupelikeBundle\Entity\Kupela;

class AdministracionController extends Controller
{
    
    public function usuariosAction($nombreSidreria)
    {
         $em = $this->getDoctrine()->getManager();
         $sagardotegi = $em->getRepository('KupelikeBundle:Sagardotegi')->findOneBy(array('nombre'=>$nombreSidreria));
    
         $kupelas = $em->getRepository('KupelikeBundle:Kupela')->findBy(array('idSagardotegi'=>$sagardotegi->getId()));

         
         return $this->render('KupelikeBundle:Administracion:usuarios.html.twig', array('sidreria'=>$sagardotegi,'kupelas' =>$kupelas));
         
         
    }
    
    public function editAction($idKupela)
    {
         $em = $this->getDoctrine()->getManager();
         $editarkupela = $em->getRepository('KupelikeBundle:Kupela')->findOneBy(array('id'=>$idKupela));
         return $this->render('KupelikeBundle:Administracion:edit.html.twig', array('kupela'=>$editarkupela));
    }
    
    public function updateKupelaAction(Request $request, $id)
    {
         $em = $this->getDoctrine()->getManager();
         $kupela = $em->getRepository("KupelikeBundle:Kupela")->find($id);
         
         $nombre = $request->query->get('nombre');
         $descripcion = $request->query->get('descripcion');
         
         $kupela->setNombre($nombre);
         $kupela->setDescripcion($descripcion);
          
         //Persistimos en el objeto
          $em->persist($kupela);
          $em->flush();
        
         return $this->redirectToRoute('administracion_usuarios', array('nombreSidreria'=>'Petritegi'));
         
        
    }
    public function deleteKupelaAction($id)
    {
         $em = $this->getDoctrine()->getManager();
         $kupela = $em->getRepository("KupelikeBundle:Kupela")->find($id);
  
          $em->removed($kupela);
          $em->flush();
        
         return $this->redirectToRoute('administracion_usuarios', array('nombreSidreria'=>'Petritegi'));
         
        
    }
      public function updateSagardotegiAction(Request $request, $id)
    {
         $em = $this->getDoctrine()->getManager();
         $sagardotegi = $em->getRepository("KupelikeBundle:Sagardotegi")->find($id);
         
         $nombre = $request->query->get('nombre');
         $descripcion = $request->query->get('descripcion');
         
         $sagardotegi->setNombre($nombre);
         $sagardotegi->setDescripcion($descripcion);
          
         //Persistimos en el objeto
          $em->persist($sagardotegi);
          $em->flush();
        
         return $this->redirectToRoute('administracion_usuarios', array('nombreSidreria'=>'Petritegi'));
         
        
    }
    public function editSidreriaAction($idSagardotegi)
    {
         $em = $this->getDoctrine()->getManager();
         $editarsagardotegi = $em->getRepository('KupelikeBundle:Sagardotegi')->findOneBy(array('id'=>$idSagardotegi));
         return $this->render('KupelikeBundle:Administracion:editSidreria.html.twig', array('sidreria'=>$editarsagardotegi));
    }
    
    public function newAction()
    {
         return $this->render('KupelikeBundle:Administracion:new.html.twig');
    }
    
    
}
