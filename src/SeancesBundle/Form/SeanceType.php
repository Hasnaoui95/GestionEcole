<?php

namespace SeancesBundle\Form;

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
            ->add('jour', ChoiceType::class, [
                'choices'  => [
                    'Lundi' => 'Lundi',
                    'Mardi' => 'Mardi',
                    'Mercredi' => 'Mercredi',
                    'Jeudi' => 'Jeudi',
                    'Vendredi' => 'Vendredi',
                    'Samedi' => 'Samedi'
                ],'attr'=>array('class'=>'form-control')])
            ->add('numSeance', ChoiceType::class, [
                'choices'  => [
                    'S1' => 'S1',
                    'S2' => 'S2',
                    'S3' => 'S3',
                    'S4' => 'S4'
                ],'attr'=>array('class'=>'form-control')])
            ->add('matiere',EntityType::class,
                array('class'=>'MatiereBundle\Entity\Matiere',
                'attr'=>array('class'=>'form-control'),
                    'choice_label'=>'libelle',
                    'expanded'=>false,
                    'multiple'=>false
                ))
            ->add('classe',EntityType::class,
                array('class'=>'NiveauBundle\Entity\Niveau',
                    'attr'=>array('class'=>'form-control'),
                    'choice_label'=>'label',
                    'expanded'=>false,
                    'multiple'=>false
                ))
            ->add('prof',EntityType::class,
                array('class'=>'UtilisateurBundle\Entity\Utilisateur',
                    'attr'=>array('class'=>'form-control'),
                    'choice_label'=>'nom',
                    'expanded'=>false,
                    'multiple'=>false
                ))
            ->add('Salle',EntityType::class,
                array('class'=>'SalleBundle\Entity\Salle',
                    'attr'=>array('class'=>'form-control'),
                    'choice_label'=>'label',
                    'expanded'=>false,
                    'multiple'=>false
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
