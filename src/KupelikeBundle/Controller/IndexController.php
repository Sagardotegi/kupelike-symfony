<?php

namespace KupelikeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use KupelikeBundle\Entity\Sagardotegi;
use KupelikeBundle\Entity\Kupela;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->render('KupelikeBundle:Index:index.html.twig');
    }
}