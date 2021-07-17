<?php

namespace UserBundle\Controller;

use SeancesBundle\Entity\Seance;
use SeancesBundle\Form\SeanceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Form\EnseignantType;

class EnseignantController extends Controller
{
    public function listeAction()
    {
        $em= $this->getDoctrine()->getManager();

        $query=$em->createQuery(
            "select m from UserBundle:User m ,UserBundle:Role r where r.id=m.Role and m.Role=2"
        );
        $users=$query->getResult();

        return $this->render('UserBundle:PagesEnseignant:liste.html.twig',
            array('users'=>$users)
        );
    }

    public function createAction(Request $request)
    {
        $u=new User();
        $form=$this->createForm(EnseignantType::class,$u);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $password=$form['password']->getData();
            $encoder = $this->container->get('security.password_encoder');
            $encodedPassword = $encoder->encodePassword($u, $password);
            $u->setPassword($encodedPassword);
            $e= $this->getDoctrine()->getManager();
            $r=$e->getRepository('UserBundle:Role')->find(2);
            $u->setRole($r);
            $u->setEnabled(1);
            $em= $this->getDoctrine()->getManager();
            $em->persist($u);
            $em->flush();

            return $this->redirectToRoute('users_enseignant');
        }
        return $this->render('UserBundle:PagesEnseignant:create.html.twig',[
                'form'=>$form->createView()
            ]
        );
    }

    public function editAction(Request $request, int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);
        $form=$this->createForm(EnseignantType::class,$user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $username=$form['username']->getData();
            $nom=$form['nom']->getData();
            $prenom=$form['prenom']->getData();
            $email=$form['email']->getData();
            $password=$form['password']->getData();
            $matiere=$form['matiere']->getData();

            $user->getUsername($username);
            $user->getNom($nom);
            $user->getPrenom($prenom);
            $user->getEmail($email);
            $user->getPassword($password);
            $user->getMatiere($matiere);

            $em= $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->addFlash('message','room created successfully');
            return $this->redirectToRoute('users_enseignant');
        }
        return $this->render('UserBundle:PagesEnseignant:edit.html.twig',[
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

        return $this->redirectToRoute("users_enseignant");
    }


}
