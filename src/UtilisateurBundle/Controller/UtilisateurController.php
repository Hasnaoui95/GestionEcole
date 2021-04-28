<?php

namespace UtilisateurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UtilisateurController extends Controller
{
	public function listeAction()
    {
    	$em= $this->getDoctrine()->getManager();
		$users=$em->getRepository('UtilisateurBundle:Utilisateur')->findAll();

        return $this->render('UtilisateurBundle:pages:liste.html.twig',
        	array('users'=>$users)
        );
    }
}
