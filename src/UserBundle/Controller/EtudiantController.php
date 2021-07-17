<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Form\EnseignantType;
use UserBundle\Form\EtudiantType;

class EtudiantController extends Controller
{
    public function listeAction()
    {
        $em= $this->getDoctrine()->getManager();

        $query=$em->createQuery(
            "select m from UserBundle:User m ,UserBundle:Role r where r.id=m.Role and m.Role=3"
        );
        $users=$query->getResult();

        return $this->render('UserBundle:PagesEtudiant:liste.html.twig',
            array('users'=>$users)
        );
    }

    public function createAction(Request $request)
    {
        $u=new User();
        $form=$this->createForm(EtudiantType::class,$u);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $password=$form['password']->getData();
            $encoder = $this->container->get('security.password_encoder');
            $encodedPassword = $encoder->encodePassword($u, $password);
            $u->setPassword($encodedPassword);
            $e= $this->getDoctrine()->getManager();
            $r=$e->getRepository('UserBundle:Role')->find(3);
            $u->setRole($r);
            $u->setEnabled(1);
            $em= $this->getDoctrine()->getManager();
            $em->persist($u);
            $em->flush();

            return $this->redirectToRoute('users_etudiant');
        }
        return $this->render('UserBundle:PagesEtudiant:create.html.twig',[
                'form'=>$form->createView()
            ]
        );
    }

    public function editAction(Request $request, int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);
        $form=$this->createForm(EtudiantType::class,$user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $username=$form['username']->getData();
            $nom=$form['nom']->getData();
            $prenom=$form['prenom']->getData();
            $email=$form['email']->getData();
            $password=$form['password']->getData();
            $classe=$form['classe']->getData();

            $user->getUsername($username);
            $user->getNom($nom);
            $user->getPrenom($prenom);
            $user->getEmail($email);
            $user->getPassword($password);
            $user->getClasse($classe);

            $em= $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->addFlash('message','room created successfully');
            return $this->redirectToRoute('users_etudiant');
        }
        return $this->render('UserBundle:PagesEtudiant:edit.html.twig',[
                'form'=>$form->createView(), 'user' => $user
            ]
        );
    }

    public function deleteAction(Request $request, int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);
        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute("users_etudiant");
    }
}
