<?php

namespace AbsenceBundle\Form;

use Doctrine\ORM\EntityRepository;
use SeancesBundle\Entity\Seance;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
                            ->setParameter('prof_id', '35')

                            ; },
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
