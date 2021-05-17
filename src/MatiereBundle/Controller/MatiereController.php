<?php

namespace MatiereBundle\Controller;

use MatiereBundle\Entity\Matiere;
use SalleBundle\Entity\Salle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class MatiereController extends Controller
{
    public function listAction()
    {
        // return $this->render('MatiereBundle:pages:liste.html.twig');

        $em= $this->getDoctrine()->getManager();
        $matiere=$em->getRepository('MatiereBundle:Matiere')->findAll();

        return $this->render('MatiereBundle:pages:liste.html.twig',
            array('matiere'=>$matiere)
        );
    }
    public function createAction(Request $request)
    {
        $matiere=new Matiere();
        $form=$this->createFormBuilder($matiere)
            ->add('libelle',TextType::Class,array('attr'=>array('class'=>'form-control')))
            ->add('coefficient',TextType::Class,array('attr'=>array('class'=>'form-control')))
            ->add('save',SubmitType::Class,array('label'=>"Ajout d'une matière",'attr'=>array('class'=>'form-control')))
            ->getForm();
        $form->handleRequest($request);

        if($form->get('save')->isClicked() && $form->isValid()){
            $libelle=$form['libelle']->getData();
            $coefficient=$form['coefficient']->getData();
            $matiere->setlibelle($libelle);
            $matiere->setcoefficient($coefficient);

            $em= $this->getDoctrine()->getManager();
            $em->persist($matiere);
            $em->flush();
            $this->addFlash('message','room created successfully');
            return $this->redirectToRoute('matiere_homepage');
        }
        return $this->render('MatiereBundle:pages:create.html.twig',[
                'form'=>$form->createView()
            ]
        );
    }

    public function deleteAction(Request $request, int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $matiere = $entityManager->getRepository(Matiere::class)->find($id);
        $entityManager->remove($matiere);
        $entityManager->flush();

        return $this->redirectToRoute("matiere_homepage");
    }

    public function editAction(Request $request, int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $matiere = $entityManager->getRepository(Matiere::class)->find($id);
        $form=$this->createFormBuilder($matiere)
            ->add('libelle',TextType::Class,array('attr'=>array('class'=>'form-control')))
            ->add('coefficient',TextType::Class,array('attr'=>array('class'=>'form-control')))
            ->add('save',SubmitType::Class,array('label'=>"Modifier Matière",'attr'=>array('class'=>'form-control')))
            ->getForm();
        $form->handleRequest($request);
        if($form->get('save')->isClicked() && $form->isValid()){
            $libelle=$form['libelle']->getData();
            $matiere->getlibelle($libelle);
            $coefficient=$form['coefficient']->getData();
            $matiere->getcoefficient($coefficient);
            $em= $this->getDoctrine()->getManager();
            $em->persist($matiere);
            $em->flush();
            $this->addFlash('message','room created successfully');
            return $this->redirectToRoute('matiere_homepage');
        }
        return $this->render('MatiereBundle:pages:edit.html.twig',[
                'form'=>$form->createView(), 'matiere' => $matiere
            ]
        );
    }


}
