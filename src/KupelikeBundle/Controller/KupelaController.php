<?php

namespace KupelikeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Facebook\Facebook;
use KupelikeBundle\Entity\Kupela;

class KupelaController extends Controller
{
    /**
     * Inserta un objeto en la tabla 'Kupela'
     */ 
    function newAction()
    {
        $appId = $this->container->getParameter('facebook_app_id');
        $secret = $this->container->getParameter('facebook_app_secret');
        
        // conectamos con facebook
        $fb = new Facebook([
            'app_id' => $appId,
            'app_secret' => $secret,
            'default_graph_version' => 'v2.8',
            'http_client_handler' => 'stream',
        ]);
        
        $helper = $fb->getJavaScriptHelper();
        
        $accessToken = $helper->getAccessToken();
        
        echo $_SESSION['fb_access_token'] = (string) $accessToken;
        
        return $this->render('KupelikeBundle:Kupela:prueba.html.twig');
    }
    
}
