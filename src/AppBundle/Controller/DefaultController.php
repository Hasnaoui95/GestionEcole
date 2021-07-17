<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('Template.html.twig'

        );
    }
    /**
     * @Route("/Accueil", name="accueilpage")
     */
    public function accueilAction()
    {
        // replace this example code with whatever you need
        return $this->render('Base.html.twig'

        );
    }
}
