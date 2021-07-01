<?php

namespace SeancesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SeancesBundle:Default:index.html.twig');
    }
}
