<?php

namespace AbsenceBundle\Controller;

use AbsenceBundle\Entity\Absence;
use AbsenceBundle\Form\AbsenceType;
use SeancesBundle\Entity\Seance;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;
use UserBundle\Entity\User;

class AbsenceController extends Controller
{
    public function createAction(Request $request , UserInterface $user)
    {
        {

            $s=new Absence();
            $form=$this->createFormBuilder($s)
                ->add('seance',EntityType::class,
                    array(
                        'class'=>'SeancesBundle\Entity\Seance',
                        'choice_label' => function($user) {
                            $u=$user->getId();
                            $entityManager = $this->getDoctrine()->getManager();
                            $test=$entityManager->getRepository(User::class)->find(35);
                            $seance  = $entityManager->getRepository(Seance::class)->findBy(array('prof' => $test));
                            return $seance->getMatiere()->getLibelle() .' '. $seance->getClasse()->getLabel(). ' ' . $seance->getJour(). ' ' . $seance->getNumSeance();
                        },
                        'attr'=>array('class'=>'form-control'),
                        'label'=>'Seance',
                        'placeholder' => 'Choisissez une Seance...',
                        'expanded'=>false ,
                    ))
            ->getForm();

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $mat_id=$form['matiere']->getData()->getID();
                $clas_id=$form['classe']->getData()->getID();
                return $this->redirectToRoute('SeanceSuivant',
                    array('matid' => $mat_id,'clasid'=>$clas_id));
            }
            return $this->render('AbsenceBundle:pages:create.html.twig',[
                    'form'=>$form->createView()
                ]
            );


        }
    }
}
