<?php

namespace SeancesBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SeanceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matiere',EntityType::class,
                   array(
                    'class'=>'MatiereBundle\Entity\Matiere',
                    'choice_label'=>'libelle',
                   'attr'=>array('class'=>'form-control'),
                    'label'=>'Matière',
                       'placeholder' => 'Choisissez une Matière...',
                ))
            ->add('classe',EntityType::class,
                array('class'=>'NiveauBundle\Entity\Niveau',
                    'attr'=>array('class'=>'form-control'),
                    'choice_label'=>'label',
                    'expanded'=>false,
                    'multiple'=>false,
                    'placeholder' => 'Choisissez une Classe...',
                ))
            ;


    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SeancesBundle\Entity\Seance'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'seancesbundle_seance';
    }


}
