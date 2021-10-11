<?php

namespace MaterielBundle\Controller;

use MaterielBundle\Entity\Materiel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class MaterielController extends Controller
{
    public function listAction()
    {
        $em= $this->getDoctrine()->getManager();
        $materiel=$em->getRepository('MaterielBundle:Materiel')->findAll();

        return $this->render('MaterielBundle:pages:liste.html.twig',
            array('materiel'=>$materiel)
        );
    }

    public function createAction(Request $request)
    {
        $materiel=new Materiel();
        $form=$this->createFormBuilder($materiel)
            ->add('designation',TextType::Class,array('attr'=>array('class'=>'form-control')))
            ->add('quantite',TextType::Class,array('attr'=>array('class'=>'form-control')))
            ->add('save',SubmitType::Class,array('label'=>"Ajout d'un Materiel",'attr'=>array('class'=>'form-control')))
            ->getForm();
        $form->handleRequest($request);

        if($form->get('save')->isClicked() && $form->isValid()){
            $designation=$form['designation']->getData();
            $materiel->getDesignation($designation);

            $quantite=$form['quantite']->getData();
            $materiel->getQuantite($quantite);
            $em= $this->getDoctrine()->getManager();
            $em->persist($materiel);
            $em->flush();
            $this->addFlash('message','level created successfully');
            return $this->redirectToRoute('materiel_homepage');
        }
        return $this->render('MaterielBundle:pages:create.html.twig',[
                'form'=>$form->createView()
            ]
        );
    }

    public function editAction(Request $request, int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $materiel = $entityManager->getRepository(Materiel::class)->find($id);
        $form=$this->createFormBuilder($materiel)
            ->add('designation',TextType::Class,array('attr'=>array('class'=>'form-control')))
            ->add('quantite',TextType::Class,array('attr'=>array('class'=>'form-control')))

            ->add('save',SubmitType::Class,array('label'=>"Modifier Matériel",'attr'=>array('class'=>'form-control')))
            ->getForm();

        $form->handleRequest($request);

        if($form->get('save')->isClicked() && $form->isValid()){
            $designation=$form['designation']->getData();
            $materiel->getDesignation($designation);

            $quantite=$form['quantite']->getData();
            $materiel->getQuantite($quantite);

            $em= $this->getDoctrine()->getManager();
            $em->persist($materiel);
            $em->flush();
            $this->addFlash('message','room created successfully');
            return $this->redirectToRoute('materiel_homepage');
        }
        return $this->render('MaterielBundle:pages:edit.html.twig',[
                'form'=>$form->createView(), 'materiel' => $materiel
            ]
        );
    }


    public function deleteAction(Request $request, int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $materiel = $entityManager->getRepository(Materiel::class)->find($id);
        $entityManager->remove($materiel);
        $entityManager->flush();

        return $this->redirectToRoute("materiel_homepage");
    }
}
