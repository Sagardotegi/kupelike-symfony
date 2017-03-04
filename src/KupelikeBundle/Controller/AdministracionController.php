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
use KupelikeBundle\Entity\Cliente;
use KupelikeBundle\Entity\Voto;


class AdministracionController extends Controller
{
 
    //funcion que nos mostrara los datos de la sidreria con sus respectivas kupelas 
    public function usuariosAction($nombreSidreria)
    {   
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if ($user->getNombreSidreria() != $nombreSidreria){
            return $this->redirectToRoute('index');
        } else {
            //buscara de la pagina sagardotegis y de la pagina kupelas cual corresponde con quien para poderlas desplegar en la vista Usuarios 
            $em = $this->getDoctrine()->getManager();
            $sagardotegi = $em->getRepository('KupelikeBundle:Sagardotegi')->findOneBy(array('nombre'=>$nombreSidreria));
            //$sagardotegi = $em->getRepository('KupelikeBundle:Sagardotegi')->findOneBy(array('id'=>$idSidreria));
            $kupelas = $em->getRepository('KupelikeBundle:Kupela')->findBy(array('idSagardotegi'=>$sagardotegi->getId()),['nombre' => 'ASC']);
            $hombres = $this->getNumHombres($em, $sagardotegi->getId());
            $mujeres = $this->getNumMujeres($em, $sagardotegi->getId());
            $fechas = $this->getNumXfecha($em, $sagardotegi->getId());
            return $this->render('KupelikeBundle:Administracion:usuarios.html.twig', array('sidreria'=>$sagardotegi,'kupelas' =>$kupelas, 'hombres' =>$hombres, 'mujeres' =>$mujeres, 'fechas' =>$fechas));
        }
    }
    
    private function getNumXfecha($em, $id)
    {        
        $query = $em->createQuery(
            "SELECT v.fecha as fecha,count(v.id) as NumVotos 
            FROM KupelikeBundle:Voto v, KupelikeBundle:Kupela k, KupelikeBundle:Sagardotegi s 
            WHERE k.id=v.kupelaId 
            AND k.idSagardotegi = s.id 
            AND s.id = :id 
            GROUP BY v.fecha 
            ORDER BY v.fecha")
            ->setParameter('id', $id);
        return $query->getResult(); 
    }
    
    private function getNumHombres($em, $id)
    {
        $query = $em->createQuery(
            "SELECT  count(v.id) as hombres, s.id as id
            FROM KupelikeBundle:Cliente c, KupelikeBundle:Kupela k, KupelikeBundle:Voto v, KupelikeBundle:Sagardotegi s
            WHERE c.sexo = 'male' 
            AND v.clienteId = c.id 
            AND v.kupelaId = k.id 
            AND k.idSagardotegi = s.id 
            AND s.id = :id 
            GROUP BY s.id")
            ->setParameter('id', $id);
        return $query->getResult(); 
    }
    
    private function getNumMujeres($em, $id)
    {
        $query = $em->createQuery(
            "SELECT  count(v.id) as mujeres, s.id as id
            FROM KupelikeBundle:Cliente c, KupelikeBundle:Kupela k, KupelikeBundle:Voto v, KupelikeBundle:Sagardotegi s
            WHERE c.sexo = 'female' 
            AND v.clienteId = c.id 
            AND v.kupelaId = k.id 
            AND k.idSagardotegi = s.id 
            AND s.id = :id 
            GROUP BY s.id")
            ->setParameter('id', $id);
        return $query->getResult();    
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
    {   //mediante la obtencion de que kupela estamos queriendo modificar cambiaremos los datos que a continuacion los actualizara 
        //automaticamente en la base de datos y en la vista en base a la sidreria en la que estemos
        $em = $this->getDoctrine()->getManager();
        $kupela = $em->getRepository("KupelikeBundle:Kupela")->find($id);
         
        $nombre = $request->request->get('nombre');
        $descripcion = $request->request->get('descripcion');
        $year = $request->request->get('year');
        $foto = $request->request->get('foto');
         
        $kupela->setNombre($nombre);
        $kupela->setDescripcion($descripcion);
        $kupela->setYear($year);
        $kupela->setFoto($foto);
        
        $em->persist($kupela);
        $em->flush();
          
        $user = $this->get('security.token_storage')->getToken()->getUser();
        
        return $this->redirectToRoute('administracion_usuarios', array('nombreSidreria'=>$user->getNombreSidreria()));
    }
    
    //la kupela seleccionada sera eliminada automaticamente actualizando ese cambio en la vista y en la base de datos
    public function deleteKupelaAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $kupela = $em->getRepository("KupelikeBundle:Kupela")->find($id);
        
        $em->remove($kupela);
        $em->flush();
        
        $user = $this->get('security.token_storage')->getToken()->getUser();
        
        return $this->redirectToRoute('administracion_usuarios', array('nombreSidreria'=>$user->getNombreSidreria()));
    }
    
    //funcion que nos permitira actualizar la sidreria al administrador de la misma 
    public function updateSagardotegiAction(Request $request, $id)
    {   //buscara mediante el id que sidreria es la que va actualizar para poder realizar las modificaciones adecuadamente
        $em = $this->getDoctrine()->getManager();
        $sagardotegi = $em->getRepository("KupelikeBundle:Sagardotegi")->find($id);
        
        $nombre = $request->request->get('nombre');
        $descripcion = $request->request->get('descripcion');
        $direccion = $request->request->get('direccion');
        $horario = $request->request->get('horario');
        $foto = $request->request->get('foto');
        $pueblo = $request->request->get('pueblo');
        $latitud = $request->request->get('latitud');
        $longitud = $request->request->get('longitud');
        $telefono = $request->request->get('telefono');
        $email = $request->request->get('email');
        
        $sagardotegi->setNombre($nombre);
        $sagardotegi->setDescripcion($descripcion);
        $sagardotegi->setDireccion($direccion);
        
        $sagardotegi->setHorario($horario);
        
        $sagardotegi->setLatitud($latitud);
        $sagardotegi->setLongitud($longitud);
        $sagardotegi->setPueblo($pueblo);
        
        $sagardotegi->setTelefono($telefono);
        $sagardotegi->setEmail($email);

        $sagardotegi->setFoto($foto);

        $em->persist($sagardotegi);
        $em->flush();
        
        //una vez guardado los cambios nos llevara a la pagina principal nuevamente en donde podremos ver los cambios echos 
        $user = $this->get('security.token_storage')->getToken()->getUser();
        
        return $this->redirectToRoute('administracion_usuarios', array('nombreSidreria'=>$user->getNombreSidreria()));
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
    public function newKupelaAction(Request $request)
    {    //crearemos el objeto kupela para que primeramente nos visualize los datos actuales y despues mostrar los nuevos
        $newKupela = new Kupela();
        $nombre = $request->request->get('nombre');
        $newKupela->setNombre($nombre);
        $descripcion= $request->request->get('descripcion');
        $newKupela->setDescripcion($descripcion);
        $idSagardotegi = $request->request->get('id-sagardotegi');
        $newKupela->setIdSagardotegi($idSagardotegi);
        $year = $request->request->get('year');
        $newKupela->setYear($year);
        $foto = $request->request->get('foto');
        $newKupela->setFoto($foto);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($newKupela);
        $em->flush();
        
        $user = $this->get('security.token_storage')->getToken()->getUser();
        
        return $this->redirectToRoute('administracion_usuarios', array('nombreSidreria'=>$user->getNombreSidreria()));
    } 
    
    /**
     * Métodos para el cambio de password
     */
    public function changePasswordAction($id)
    {
        $repo = $this->getDoctrine()->getRepository('KupelikeBundle:Usuario');
        $usuario = $repo->find($id);
        
        return $this->render('KupelikeBundle:Administracion:changePassword.html.twig', array('usuario' => $usuario));
    }
    
    public function updatePasswordAction($id, Request $req)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('KupelikeBundle:Usuario')->find($id);
        
        $passActual = $req->get('password-actual');
        $passNueva = $req->get('password-nueva');
        $rePass = $req->get('password-repetir');
        
        if(!empty($passActual) && !empty($passNueva) && !empty($rePass)){
            if(password_verify($passActual, $usuario->getPassword())){
                if($passNueva == $rePass){
                    
                    $encoder = $this->container->get('security.password_encoder');
                    $encoded = $encoder->encodePassword($usuario, $passNueva);
                    $usuario->setPassword($encoded);
                    
                    $em->flush();
            
                    $successMessage = $this->get('translator')->trans('La contraseña ha sido modificado correctamente.');
                    $this->addFlash('mensaje', $successMessage);
                    $user = $this->get('security.token_storage')->getToken()->getUser();
        
                    return $this->redirectToRoute('administracion_usuarios', array('nombreSidreria'=>$user->getNombreSidreria()));
                } else {
                    $errorMessage = $this->get('translator')->trans('La nueva contraseña no coincide.');
                    $this->addFlash('mensaje', $errorMessage);
                    return $this->render('KupelikeBundle:Administracion:changePassword.html.twig', array('usuario' => $usuario));
                }
            } else {
                $errorMessage = $this->get('translator')->trans('Las contraseñas no coinciden.');
                $this->addFlash('mensaje', $errorMessage);
                return $this->render('KupelikeBundle:Administracion:changePassword.html.twig', array('usuario' => $usuario));
            }
        } else {
            $errorMessage = $this->get('translator')->trans('Todos los campos son obligatorios.');
            $this->addFlash('mensaje', $errorMessage);
            return $this->render('KupelikeBundle:Administracion:changePassword.html.twig', array('usuario' => $usuario));
        }
    }
   
}