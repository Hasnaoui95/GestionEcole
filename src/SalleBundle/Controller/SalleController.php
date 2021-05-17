<?php

namespace SalleBundle\Controller;

use SalleBundle\Entity\Salle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use UtilisateurBundle\Entity\Utilisateur;

class SalleController extends Controller
{
    public function listAction()
    {
       // return $this->render('SalleBundle:pages:liste.html.twig');

        $em= $this->getDoctrine()->getManager();
        $salles=$em->getRepository('SalleBundle:Salle')->findAll();

        return $this->render('SalleBundle:pages:liste.html.twig',
            array('salles'=>$salles)
        );
    }

    public function createAction(Request $request)
    {
        $salle=new Salle();
        $form=$this->createFormBuilder($salle)
            ->add('label',TextType::Class,array('attr'=>array('class'=>'form-control')))
           // ->add('type',ChoiceType::Class,array('attr'=>array('class'=>'form-control')))
            /*, 'choices'  => [
                'labo' => 'labo',
                'amphi' => 'amphi',
                'salle' => 'salle',
            ])))*/
           ->add('type', ChoiceType::class, [
               'choices'  => [
                   'Labo' => 'labo',
                   'Amphi' => 'amphi',
                   'Salle' => 'salle'
               ],'attr'=>array('class'=>'form-control')])
            ->add('save',SubmitType::Class,array('label'=>"Ajout d'une salle",'attr'=>array('class'=>'form-control')))
            ->getForm();
        $form->handleRequest($request);

       if($form->get('save')->isClicked() && $form->isValid()){
            $label=$form['label']->getData();
            $type=$form['type']->getData();
            $salle->setLabel($label);
            $salle->setType($type);

            $em= $this->getDoctrine()->getManager();
            $em->persist($salle);
            $em->flush();
            $this->addFlash('message','room created successfully');
            return $this->redirectToRoute('salle_homepage');
        }
        return $this->render('SalleBundle:pages:create.html.twig',[
                'form'=>$form->createView()
            ]
        );
    }

    public function deleteAction(Request $request, int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $salle = $entityManager->getRepository(Salle::class)->find($id);
        $entityManager->remove($salle);
        $entityManager->flush();

        return $this->redirectToRoute("salle_homepage");
    }

    public function editAction(Request $request, int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $salle = $entityManager->getRepository(Salle::class)->find($id);
        //$salle=new Salle();
        $form=$this->createFormBuilder($salle)
            ->add('label',TextType::Class,array('attr'=>array('class'=>'form-control')))
            ->add('type', ChoiceType::class, [
                'choices'  => [
                    'Labo' => 'labo',
                    'Amphi' => 'amphi',
                    'Salle' => 'salle'
                ],'attr'=>array('class'=>'form-control')])
                // not working
                // 'multiple' => false, 'data' => 'labo'])

            ->add('save',SubmitType::Class,array('label'=>"Ajout d'une salle",'attr'=>array('class'=>'form-control')))
            ->getForm();
        //$form['type']->getData($salle->getType());
        $form->handleRequest($request);

        if($form->get('save')->isClicked() && $form->isValid()){
            $label=$form['label']->getData();
            $type=$form['type']->getData();
            $salle->setLabel($label);
            $salle->setType($type);

            $em= $this->getDoctrine()->getManager();
            $em->persist($salle);
            $em->flush();
            $this->addFlash('message','room created successfully');
            return $this->redirectToRoute('salle_homepage');
        }
        return $this->render('SalleBundle:pages:edit.html.twig',[
                'form'=>$form->createView(), 'salle' => $salle
            ]
        );
    }

}
