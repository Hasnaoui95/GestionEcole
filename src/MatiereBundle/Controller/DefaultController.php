<?php

namespace MatiereBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MatiereBundle:Default:index.html.twig');
    }
}
