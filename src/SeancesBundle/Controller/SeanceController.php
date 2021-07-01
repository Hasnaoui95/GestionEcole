<?php

namespace SeancesBundle\Controller;
use MaterielBundle\Entity\Materiel;
use SeancesBundle\Entity\Seance;
use SeancesBundle\Form\SeanceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;


class SeanceController extends Controller
{
    public function listeAction()
    {
        $em= $this->getDoctrine()->getManager();
        $seances=$em->getRepository('SeancesBundle:Seance')->findAll();

        return $this->render('SeancesBundle:pages:liste.html.twig',
            array('seances'=>$seances)
        );
    }

    public function createAction(Request $request)
    {
        $s=new Seance();
        $form=$this->createForm(SeanceType::class,$s);
        $form

        ->add('save',SubmitType::Class,array('label'=>"Valider",
                'attr'=>array('class'=>'btn btn-primary float-right')));
        $form->handleRequest($request);

        if($form->get('save')->isClicked() && $form->isValid()){
            $em= $this->getDoctrine()->getManager();
            $em->persist($s);
            $em->flush();
            $this->addFlash('message','room created successfully');
            return $this->redirectToRoute('seances_homepage');
        }
        return $this->render('SeancesBundle:pages:create.html.twig',[
                'form'=>$form->createView()
            ]
        );


    }


    public function deleteAction(Request $request, int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $seance = $entityManager->getRepository(Seance::class)->find($id);
        $entityManager->remove($seance);
        $entityManager->flush();

        return $this->redirectToRoute("seances_homepage");
    }


}
