<?php

namespace EmploiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EmploieBundle:pages:EmploiEtudiant.html.twig');
    }
}
