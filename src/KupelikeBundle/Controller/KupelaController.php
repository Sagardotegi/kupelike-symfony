<?php

namespace KupelikeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use KupelikeBundle\Entity\Kupela;

class KupelaController extends Controller
{
    public function indexAction()
    {
        return $this->render('KupelikeBundle:Kupela:index.html.twig');
    }
}
