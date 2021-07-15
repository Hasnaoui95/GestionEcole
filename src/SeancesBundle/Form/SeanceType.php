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
            ->add('prof',EntityType::class,
                array('class'=>'UserBundle\Entity\User',
                    'attr'=>array('class'=>'form-control'),
                    'choice_label'=>'NomPrenom',
                    'expanded'=>false,
                    'multiple'=>false,
                    'placeholder' => 'Choisissez un/une Prof...',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                            ->where('u.Role=?1')
                            ->setParameter(1, '2')

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
