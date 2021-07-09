<?php

namespace UserBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtudiantType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',TextType::Class,array(
                'attr'=>array('class'=>'form-control','placeholder'=>'Username'),
                'label'=>'Username :',


            ))
            ->add('nom',TextType::Class,array(
                'attr'=>array('class'=>'form-control','placeholder'=>'Nom'),
                'label'=>'Nom :',

            ))
            ->add('prenom',TextType::Class,array(
                'attr'=>array('class'=>'form-control','placeholder'=>'Prenom'),
                'label'=>'Prenom :',

            ))
            ->add('email',TextType::Class,array(
                'attr'=>array('class'=>'form-control','placeholder'=>'Email'),
                'label'=>'Email :',

            ))

            ->add('password',PasswordType::Class,array(
                'attr'=>array('class'=>'form-control','placeholder'=>'Password'),
                'label'=>'Password :',

            ))
            ->add('classe',EntityType::class,
                array('class'=>'NiveauBundle\Entity\Niveau',
                    'attr'=>array('class'=>'form-control'),
                    'label'=>'Classe :',
                    'choice_label'=>'label',
                    'expanded'=>false,
                    'multiple'=>false,
                    'placeholder' => 'Choisissez une Classe...',
                ))


        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_user';
    }


}
