<?php

namespace KupelikeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use KupelikeBundle\Entity\Usuario;
use KupelikeBundle\Entity\Sagardotegi;

class UsuarioController extends Controller
{
    
    /**
     * Panel de administración de usuarios
     */ 
    
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $usuarios = $em->getRepository('KupelikeBundle:Usuario')->findAll();
        
        return $this->render('KupelikeBundle:Usuarios:index.html.twig', array('usuarios' => $usuarios));
    }
    
    public function newAction()
    {
        return $this->render('KupelikeBundle:Usuarios:new.html.twig');
    }
    
    public function newUserAction(Request $request)
    {
        // cogemos los datos del formulario y los asignamos al usuario
        $usuario = new Usuario();
        $nombre = $request->query->get('nombre');
        $usuario->setNombre($nombre);
        $apellidos = $request->query->get('apellidos');
        $usuario->setApellidos($apellidos);
        $idSagardotegi = $request->query->get('id-sidreria');
        $usuario->setIdSidreria($idSagardotegi);
        $nombreSagardotegi = $request->query->get('nombre-sidreria');
        $usuario->setNombreSidreria($nombreSagardotegi);
        $telefono = $request->query->get('telefono');
        $usuario->setTelefono($telefono);
        $email = $request->query->get('email');
        $usuario->setEmail($email);
        $direccion = $request->query->get('direccion');
        $usuario->setDireccion($direccion);
        $username = $request->query->get('username');
        $usuario->setUsername($username);
        
        // password por defecto
        $password = 'abc123';
        $encoder = $this->container->get('security.password_encoder');
        $passwordEncriptada = $encoder->encodePassword($usuario, $password);
        $usuario->setPassword($passwordEncriptada);
        
        // añadimos el usuario a la base de datos
        $em = $this->getDoctrine()->getManager();
        $em->persist($usuario);
        $em->flush();
        
        // mensaje flash de que el usuario se ha creado correctamente
        $successMessage = $this->get('translator')->trans('El usuario se ha creado correctamente.');
        $this->addFlash('mensaje', $successMessage);
        
        return $this->redirectToRoute('panel_usuarios');
    }
    
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('KupelikeBundle:Usuario')->find($id);
        
        return $this->render('KupelikeBundle:Usuarios:edit.html.twig', array('usuario' => $usuario));
    }
    
    public function actualizarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('KupelikeBundle:Usuario')->find($id);
        
        // cogemos los datos del formulario y los asignamos al usuario
        $nombre = $request->query->get('nombre');
        $usuario->setNombre($nombre);
        $apellidos = $request->query->get('apellidos');
        $usuario->setApellidos($apellidos);
        $idSagardotegi = $request->query->get('id-sidreria');
        $usuario->setIdSidreria($idSagardotegi);
        $nombreSagardotegi = $request->query->get('nombre-sidreria');
        $usuario->setNombreSidreria($nombreSagardotegi);
        $telefono = $request->query->get('telefono');
        $usuario->setTelefono($telefono);
        $email = $request->query->get('email');
        $usuario->setEmail($email);
        $direccion = $request->query->get('direccion');
        $usuario->setDireccion($direccion);
        $username = $request->query->get('username');
        $usuario->setUsername($username);
        
        // añadimos el usuario a la base de datos
        $em->persist($usuario);
        $em->flush();
        
        // mensaje flash de que el usuario se ha creado correctamente
        $successMessage = $this->get('translator')->trans('El usuario se ha modificado correctamente.');
        $this->addFlash('mensaje', $successMessage);
        
        return $this->redirectToRoute('panel_usuarios');
    }
    
    /**
     * Crea una nueva Sagardotegi
     */
    public function newSagardotegiFormAction()
    {
        return $this->render('KupelikeBundle:Usuarios:newSagardotegi.html.twig');
    }
    
    public function newSagardotegiAction(Request $request)
    {
        $sagardotegi = new Sagardotegi();
        
        $nombre = $request->request->get('nombre');
        $direccion = $request->request->get('direccion');
        $descripcion = $request->request->get('descripcion');
        $pueblo = $request->request->get('pueblo');
        $latitud = $request->request->get('latitud');
        $longitud = $request->request->get('longitud');
        /** @var Symfony\Component\HttpFoundation\File\UploadedFile $foto */
        $foto = $request->files->get('foto');
        if($foto != null){
            // asignamos un nombre al archivo generado automáticamente
            $nombreFoto = $this->get('app.sagardotegi_uploader')->upload($foto);
            $sagardotegi->setFoto('uploads/sagardotegis/' . $nombreFoto);
        }
        
        $sagardotegi->setNombre($nombre);
        $sagardotegi->setDescripcion($descripcion);
        $sagardotegi->setDireccion($direccion);
        $sagardotegi->setLatitud($latitud);
        $sagardotegi->setLongitud($longitud);
        $sagardotegi->setPueblo($pueblo);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($sagardotegi);
        $em->flush();
        
        // mensaje flash de que el usuario se ha creado correctamente
        $successMessage = $this->get('translator')->trans('Se ha creado la sidrería.');
        $this->addFlash('mensaje', $successMessage);
        
        return $this->redirectToRoute('panel_usuarios');
        
    }
    
}
