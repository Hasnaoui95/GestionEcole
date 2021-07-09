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
        return $this->render('Template.html.twig'

        );
    }

    /**
     * @Route("/ajoutUser", name="AjoutUser")
     */
    public function ajoutAction(){

        $user = new User();
        $em= $this->getDoctrine()->getManager();

        $user->setUsername('test');
        $user->setEmail('test@gmail.com');
        $user->setEnabled(1);

        $currentPassword = '12345';
        $encoder = $this->container->get('security.password_encoder');
        $encodedPassword = $encoder->encodePassword($user, $currentPassword);
        $user->setPassword($encodedPassword);
        $em->persist($user);
        $em->flush();
        return $this->redirectToRoute('utilisateurs');



    }
}
