<?php

namespace MaterielBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MaterielBundle:Default:index.html.twig');
    }
}
