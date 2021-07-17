<?php

namespace SeancesBundle\Controller;
use MaterielBundle\Entity\Materiel;
use SeancesBundle\Entity\Seance;
use SeancesBundle\Form\SeanceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use UserBundle\Entity\Role;
use Doctrine\ORM\EntityRepository;


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

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $mat_id=$form['matiere']->getData()->getID();
            $clas_id=$form['classe']->getData()->getID();
            return $this->redirectToRoute('SeanceSuivant',
                array('matid' => $mat_id,'clasid'=>$clas_id));
        }
        return $this->render('SeancesBundle:pages:create1.html.twig',[
                'form'=>$form->createView()
            ]
        );


    }
    public function suivantAction(Request $request,int $matid,int $clasid)
    {
        $s=new Seance();

        $form=$this->createFormBuilder($s)
            ->add('jour', ChoiceType::class, [
                'choices'  => [
                    'Choisissez un Jour...'=>'choisir',
                    'Lundi' => 'Lundi',
                    'Mardi' => 'Mardi',
                    'Mercredi' => 'Mercredi',
                    'Jeudi' => 'Jeudi',
                    'Vendredi' => 'Vendredi',
                    'Samedi' => 'Samedi'
                ],'attr'=>array('class'=>'form-control')])
            ->add('numSeance', ChoiceType::class,
                [
                    'choices'  => [
                        'Choisissez une Séance...'=>'choice',
                        '8h00 - 10h00'=>[
                            'S1' => 'S1'],
                        '10h00 - 12h00'=>[
                            'S2' => 'S2'],
                        '13h00 - 15h00'=>[
                            'S3' => 'S3'],
                        '15h0 - 17h00'=>[
                            'S4' => 'S4']
                    ],
                    'label'=>'Séance',
                    'attr'=>array('class'=>'form-control')]
            )
            ->add('prof',EntityType::class,
                array('class'=>'UserBundle\Entity\User',
                    'attr'=>array('class'=>'form-control'),
                    'choice_label'=>'NomPrenom',
                    'expanded'=>false,
                    'multiple'=>false,
                    'placeholder' => 'Choisissez un/une Prof...',
                    'query_builder' => function (EntityRepository $er)use($matid) {
                        return $er->createQueryBuilder('u')
                            ->where('u.Role= :role')
                            ->andWhere('u.matiere= :nom')
                            ->setParameter('role', '2')
                            ->setParameter('nom',$matid)

                            ;
                    },
                ))

            ->add('Salle',EntityType::class,
                array('class'=>'SalleBundle\Entity\Salle',
                    'attr'=>array('class'=>'form-control'),
                    'choice_label'=>'label',
                    'expanded'=>false,
                    'multiple'=>false,
                    'placeholder' => 'Choisissez une Salle...',
                ))
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em= $this->getDoctrine()->getManager();
            $m= $em->getRepository('MatiereBundle:Matiere')->find($matid);
            $c= $em->getRepository('NiveauBundle:Niveau')->find($clasid);
            $s->setMatiere($m);
            $s->setClasse($c);
            $em->persist($s);
            $em->flush();
            return $this->redirectToRoute('seances_homepage');
        }
        return $this->render('SeancesBundle:pages:create2.html.twig',[
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
