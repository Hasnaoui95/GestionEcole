<?php

namespace UserBundle\Controller;

use MaterielBundle\Entity\Materiel;
use SeancesBundle\Entity\Seance;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Role;
use UserBundle\Entity\User;
use UtilisateurBundle\Entity\Utilisateur;

class AdminController extends Controller
{
    public function listeAction()
    {
        $em= $this->getDoctrine()->getManager();

        $query=$em->createQuery(
            "select m from UserBundle:User m ,UserBundle:Role r where r.id=m.Role and m.Role=1"
        );
        $users=$query->getResult();

        return $this->render('UserBundle:PagesAdmin:liste.html.twig',
            array('users'=>$users)
        );
    }

    public function createAction(Request $request)
    {
        $user=new User();

        $form=$this->createFormBuilder($user)
            ->add('username',TextType::Class,array())
            ->add('nom',TextType::Class,array())
            ->add('prenom',TextType::Class,array())
            ->add('email',TextType::Class,array())
            ->add('password',PasswordType::Class,array())
            ->add('save',SubmitType::Class,array('label'=>'Modifier user','attr'=>array('class'=>'form-control')))
            ->getForm();
        $form->handleRequest($request);

        if($form->get('save')->isClicked() && $form->isValid()){
            $username=$form['username']->getData();
            $nom=$form['nom']->getData();
            $prenom=$form['prenom']->getData();
            $email=$form['email']->getData();
            $password=$form['password']->getData();

            $user->setUsername($username);
            $user->setNom($nom);
            $user->setPrenom($prenom);
            $user->setEmail($email);

            $e= $this->getDoctrine()->getManager();
            $r=$e->getRepository('UserBundle:Role')->find(1);
            $user->setRole($r);
            $user->setEnabled(1);

            $encoder = $this->container->get('security.password_encoder');
            $encodedPassword = $encoder->encodePassword($user, $password);
            $user->setPassword($encodedPassword);

            $em= $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('users_admin');
        }
        return $this->render('UserBundle:PagesAdmin:create1.html.twig',[
                'form'=>$form->createView()
            ]
        );
    }

    public function deleteAction(Request $request, int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);
        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute("users_admin");
    }


    public function editAction(Request $request, int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);
        $form=$this->createFormBuilder($user)
            ->add('username',TextType::Class,array())
            ->add('nom',TextType::Class,array())
            ->add('prenom',TextType::Class,array())
            ->add('email',TextType::Class,array())
            ->add('password',PasswordType::Class,array())
            ->add('save',SubmitType::Class,array('label'=>'Modifier user','attr'=>array('class'=>'form-control')))
            ->getForm();

        $form->handleRequest($request);

        if($form->get('save')->isClicked() && $form->isValid()){
            $username=$form['username']->getData();
            $nom=$form['nom']->getData();
            $prenom=$form['prenom']->getData();
            $email=$form['email']->getData();
            $password=$form['password']->getData();

            $user->getUsername($username);
            $user->getNom($nom);
            $user->getPrenom($prenom);
            $user->getEmail($email);
            $user->getPassword($password);

            $em= $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->addFlash('message','room created successfully');
            return $this->redirectToRoute('users_admin');
        }
        return $this->render('UserBundle:PagesAdmin:edit.html.twig',[
                'form'=>$form->createView(), 'user' => $user
            ]
        );
    }
}
