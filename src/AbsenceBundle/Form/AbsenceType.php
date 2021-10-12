<?php

namespace AbsenceBundle\Form;

use NiveauBundle\Entity\Niveau;
use SeancesBundle\Entity\Seance;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\User\UserInterface;

class AbsenceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('seance',EntityType::class,
                array(
                    'class'=>'SeancesBundle\Entity\Seance',
                    'choice_label' => function($seance ) {
                        /** @var Seance $seance */
                        /** @var UserInterface $user */
                        $u=$user->getId();
                        $entityManager = $this->getDoctrine()->getManager();
                        $seance  = $entityManager->getRepository(Seance::class)->findBy(array('prof' => $u));
                        return $seance->getMatiere()->getLibelle() .' '. $seance->getClasse()->getLabel(). ' ' . $seance->getJour(). ' ' . $seance->getNumSeance();
                    },
                    'attr'=>array('class'=>'form-control'),
                    'label'=>'Seance',
                    'placeholder' => 'Choisissez une Seance...',
                ))
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AbsenceBundle\Entity\Absence'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'absencebundle_absence';
    }


}
