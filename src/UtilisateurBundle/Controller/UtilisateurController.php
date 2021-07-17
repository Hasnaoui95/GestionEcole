<?php

namespace UtilisateurBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UtilisateurBundle\Entity\Utilisateur;


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

    public function createAction(Request $request)
    {
    	$user=new Utilisateur();
    	$form=$this->createFormBuilder($user)
    	->add('nom',TextType::Class,array('attr'=>array('class'=>'form-control')))
    	->add('prenom',TextType::Class,array('attr'=>array('class'=>'form-control')))
        ->add('dns', DateType::class, [
        'widget' => 'single_text','attr'=>array('class'=>'form-control')])
    	->add('sexe', ChoiceType::class, [
            'choices'  => [
                'Homme' => 1,
                'Femme' => 0
            ],'attr'=>array('class'=>'form-control')])
    	->add('save',SubmitType::Class,array('label'=>'Create user','attr'=>array('class'=>'form-control')))
    	->getForm();
    	$form->handleRequest($request);

    	if($form->get('save')->isClicked() && $form->isValid()){
    		$nom=$form['nom']->getData();
    		$prenom=$form['prenom']->getData();
            $dns=$form['dns']->getData();
            $sexe=$form['sexe']->getData();

    		$user->setNom($nom);
    		$user->setPrenom($prenom);
            $user->setDns($dns);
            $user->setSexe($sexe);

    		$em= $this->getDoctrine()->getManager();
    		$em->persist($user);
    		$em->flush();
    		$this->addFlash('message','user create successfully');
    		return $this->redirectToRoute('utilisateurs');
    	}
        return $this->render('UtilisateurBundle:pages:create1.html.twig',[
            'form'=>$form->createView()
            ]
        );
    }
}
