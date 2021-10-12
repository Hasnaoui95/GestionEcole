<?php

namespace AbsenceBundle\Controller;

use AbsenceBundle\Entity\Absence;
use AbsenceBundle\Form\AbsenceType;
use Doctrine\ORM\EntityRepository;
use SeancesBundle\Entity\Seance;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

class AbsenceController extends Controller
{
    public function createAction(Request $request , UserInterface $user)
    {
        {
            $prof_id=$user->getId();
            $s=new Absence();

            $form=$this->createFormBuilder($s)
                ->add('seance',EntityType::class,
                    array(
                        'class'=>'SeancesBundle\Entity\Seance',
                        'choice_label' => function($seance) {
                            /** @var Seance $seance */
                            return $seance->getMatiere()->getLibelle() .' '. $seance->getClasse()->getLabel(). ' ' . $seance->getJour(). ' ' . $seance->getNumSeance();
                        },
                        'attr'=>array('class'=>'form-control'),
                        'label'=>'Seance',
                        'placeholder' => 'Choisissez une Seance...',
                        'query_builder' => function (EntityRepository $er) use($prof_id) {
                            return $er->createQueryBuilder('se')
                                ->where('se.prof= :prof_id')
                                ->setParameter('prof_id', $prof_id)

                                ; },
                    ))
                ->getForm() ;

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $seance_id=$form['seance']->getData()->getID();
                return $this->redirectToRoute('AbsenceSuivant',
                    array('seance_id' => $seance_id));
            }
            return $this->render('AbsenceBundle:pages:create.html.twig',[
                    'form'=>$form->createView()
                ]
            );


        }
    }

    public function suivantAction(Request $request,int $seance_id)
    {
        $em= $this->getDoctrine()->getManager();
        $seance=$em->getRepository('SeancesBundle:Seance')->find($seance_id);
        $s=new Absence();
        $class_id=$seance->getClasse();
        $etudiants=$em->getRepository('UserBundle:User')->findBy(array('classe' => $class_id));

        $form=$this->createFormBuilder($s)
            ->add('statut')
            ->add('etudiant')
            ->getForm() ;

        if($form->isSubmitted()){
            $statut=$form['statut']->getData();
            $etudiant_id=$form['etudiant']->getData();
            $s->setStatut('P');
            $s->setEtudiant(38);
            $s->setSeance(2);

            $em= $this->getDoctrine()->getManager();
            $em->persist($s);
            $em->flush();
            return $this->redirectToRoute('absenceCreate');
        }

        return $this->render('AbsenceBundle:pages:create2.html.twig',[
            'form'=>$form->createView(),'etudiants'=>$etudiants
            ]
        );

    }
}
