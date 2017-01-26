<?php

namespace KupelikeBundle\Controller;

//los paquetes necesarios para que las funciones puedan utilizarse 
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
   //funcion que nos mostrara los datos de la sidreria con sus respectivas kupelas 
    public function usuariosAction($nombreSidreria)
    {    //buscara de la pagina sagardotegis y de la pagina kupelas cual corresponde con quien para poderlas desplegar
         //en la vista Usuarios 
         $em = $this->getDoctrine()->getManager();
         $sagardotegi = $em->getRepository('KupelikeBundle:Sagardotegi')->findOneBy(array('nombre'=>$nombreSidreria));
         $kupelas = $em->getRepository('KupelikeBundle:Kupela')->findBy(array('idSagardotegi'=>$sagardotegi->getId()));
         return $this->render('KupelikeBundle:Administracion:usuarios.html.twig', array('sidreria'=>$sagardotegi,'kupelas' =>$kupelas));
         
         
    }
    //funcion para editar las kupelas individualmente
    public function editAction($id)
    {    //obteniendo el id correspondiete a la kupela que queremos nos llevara a otra vista con los datos actuales de esa kupela 
         //para despues poderla editar con los nuevos datos
         $em = $this->getDoctrine()->getManager();
         $editarkupela = $em->getRepository('KupelikeBundle:Kupela')->findOneBy(array('id'=>$id));
         return $this->render('KupelikeBundle:Administracion:edit.html.twig', array('kupela'=>$editarkupela));
    }
    //funcion la cual nos actualizara los nuevos datos introducidos a la kupela seleccionada anteriormente
    public function updateKupelaAction(Request $request, $id)
    {    //mediante la obtencion de que kupela estamos queriendo modificar cambiaremos los datos que a continuacion los actualizara 
         //automaticamente en la base de datos y en la vista en base a la sidreria en la que estemos
         $em = $this->getDoctrine()->getManager();
         $kupela = $em->getRepository("KupelikeBundle:Kupela")->find($id);
         
         $nombre = $request->query->get('nombre');
         $descripcion = $request->query->get('descripcion');
         
         $kupela->setNombre($nombre);
         $kupela->setDescripcion($descripcion);
          
         
          $em->persist($kupela);
          $em->flush();
        
         return $this->redirectToRoute('administracion_usuarios', array('nombreSidreria'=>'Petritegi'));
         
        
    }
    //la kupela seleccionada sera eliminada automaticamente actualizando ese cambio en la vista y en la base de datos
    public function deleteKupelaAction($id)
    {
         $em = $this->getDoctrine()->getManager();
         $kupela = $em->getRepository("KupelikeBundle:Kupela")->find($id);
  
          $em->remove($kupela);
          $em->flush();
        
         return $this->redirectToRoute('administracion_usuarios', array('nombreSidreria'=>'Petritegi'));
         
        
    }
    //funcion que nos permitira actualizar la sidreria al administrador de la misma 
    public function updateSagardotegiAction(Request $request, $id)
    {    //buscara mediante el id que sidreria es la que va actualizar para poder realizar las modificaciones adecuadamente
         $em = $this->getDoctrine()->getManager();
         $sagardotegi = $em->getRepository("KupelikeBundle:Sagardotegi")->find($id);
         
         $nombre = $request->query->get('nombre');
         $descripcion = $request->query->get('descripcion');
         
         $sagardotegi->setNombre($nombre);
         $sagardotegi->setDescripcion($descripcion);
          
         
          $em->persist($sagardotegi);
          $em->flush();
         //una vez guardado los cambios nos llevara a la pagina principal nuevamente en donde podremos ver los cambios echos 
         return $this->redirectToRoute('administracion_usuarios', array('nombreSidreria'=>'Petritegi'));
         
        
    }
    public function editSidreriaAction($idSagardotegi)
    {
         $em = $this->getDoctrine()->getManager();
         $editarsagardotegi = $em->getRepository('KupelikeBundle:Sagardotegi')->findOneBy(array('id'=>$idSagardotegi));
         return $this->render('KupelikeBundle:Administracion:editSidreria.html.twig', array('sidreria'=>$editarsagardotegi));
    }
    //nos llevara a la vista para poder introducir una nueva kupela
    public function newAction()
    {
         return $this->render('KupelikeBundle:Administracion:new.html.twig');
    }
    //funcion que nos permitira que se actualizen y se mofiquen los cambios tanto en la base de datos como en la propia vista
    public function newKupelaAction( Request $request)
    {    //crearemos el objeto kupela para que primeramente nos visualize los datos actuales y despues mostrar los nuevos
         $newKupela = new Kupela();
         $nombre = $request->query->get('nombre');
         $newKupela->setNombre($nombre);
         $descripcion= $request->query->get('descripcion');
         $newKupela->setDescripcion($descripcion);
         $idSagardotegi = $request->query->get('id-sagardotegi');
         $newKupela->setIdSagardotegi($idSagardotegi);
         $year = $request->query->get('year');
         $newKupela->setYear($year);
         $newKupela->setFoto("/web/uploads/kupelas/kupela1.jpg");
         
         $em = $this->getDoctrine()->getManager();
         $em->persist($newKupela);
         $em->flush();
         
         return $this->redirectToRoute('administracion_usuarios', array('nombreSidreria'=>'Petritegi'));

        
    } 
    
    
    
    
   
}