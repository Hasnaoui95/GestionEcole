<?php

namespace NiveauBundle\Controller;

use NiveauBundle\Entity\Niveau;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class NiveauController extends Controller
{
    public function listAction()
    {

        $em= $this->getDoctrine()->getManager();
        $niveaux=$em->getRepository('NiveauBundle:Niveau')->findAll();

        return $this->render('NiveauBundle:pages:liste.html.twig',
            array('niveaux'=>$niveaux)
        );
    }

    public function createAction(Request $request)
    {
        $niveau=new Niveau();
        $form=$this->createFormBuilder($niveau)
            ->add('label',TextType::Class,array('attr'=>array('class'=>'form-control')))
            ->add('save',SubmitType::Class,array('label'=>"Ajout d'un niveau",'attr'=>array('class'=>'form-control')))
            ->getForm();
        $form->handleRequest($request);

       if($form->get('save')->isClicked() && $form->isValid()){
            $label=$form['label']->getData();
            $niveau->setLabel($label);

            $em= $this->getDoctrine()->getManager();
            $em->persist($niveau);
            $em->flush();
            $this->addFlash('message','level created successfully');
            return $this->redirectToRoute('niveau_homepage');
        }
        return $this->render('NiveauBundle:pages:create.html.twig',[
                'form'=>$form->createView()
            ]
        );
    }

    public function deleteLevelAction(Request $request, int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $niveau = $entityManager->getRepository(Niveau::class)->find($id);
        $entityManager->remove($niveau);
        $entityManager->flush();

        return $this->redirectToRoute("niveau_homepage");
    }

    public function editLevelAction(Request $request, int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $niveau = $entityManager->getRepository(Niveau::class)->find($id);
        $form=$this->createFormBuilder($niveau)
            ->add('label',TextType::Class,array('attr'=>array('class'=>'form-control')))
            ->add('save',SubmitType::Class,array('label'=>"Ajout d'un Niveau",'attr'=>array('class'=>'form-control')))
            ->getForm();
        $form->handleRequest($request);

        if($form->get('save')->isClicked() && $form->isValid()){
            $label=$form['label']->getData();
            $niveau->setLabel($label);

            $em= $this->getDoctrine()->getManager();
            $em->persist($niveau);
            $em->flush();
            $this->addFlash('message','room created successfully');
            return $this->redirectToRoute('niveau_homepage');
        }
        return $this->render('NiveauBundle:pages:edit.html.twig',[
                'form'=>$form->createView(), 'niveau' => $niveau
            ]
        );
    }
}
