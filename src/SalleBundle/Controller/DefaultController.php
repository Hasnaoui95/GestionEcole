<?php

namespace SalleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SalleBundle:Default:index.html.twig');
    }
}
