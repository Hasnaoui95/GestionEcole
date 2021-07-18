<?php

namespace EmploieBundle\Controller;

use SalleBundle\Entity\Salle;
use SeancesBundle\Entity\Seance;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use NiveauBundle\Entity\Niveau;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use EmploieBundle\utils\EmploiItem;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $form=$this->createFormBuilder()->add('Niveau:',EntityType::class,
        array('class'=>'NiveauBundle\Entity\Niveau',
            'attr'=>array('label'=>'form-control', 'class'=>'form-control'),
            'choice_label'=>'label',
            'choice_value' => 'id',
            'expanded'=>false,
            'multiple'=>false,
            'placeholder' => 'Choisissez une Classe...',
        ))
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $niveauID=$form['Niveau:']->getData()->getID();
            return $this->redirectToRoute('emploi', array('id' => $niveauID));
        }
       return $this->render('EmploieBundle:pages:EmploiEtudiantHome.html.twig',[
               'form'=>$form->createView()
           ]
       );
    }

    public function emploiAction(Request $request, int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $niveau = $entityManager->getRepository(Niveau::class)->find($id);
        $seances  = $entityManager->getRepository(Seance::class)->findBy(array('classe' => $id));

        $item1 = new EmploiItem();
        $item2 = new EmploiItem();
        $item3 = new EmploiItem();
        $item4 = new EmploiItem();
        for($i=0;$i<count($seances);$i++) {

            $seanceDetail = $seances[$i]->getMatiere()->getLibelle().'-'.$seances[$i]->getProf()->getNom(). ' '. $seances[$i]->getProf()->getPrenom()
            . ' ' . $seances[$i]->getSalle()->getLabel();


            if ($seances[$i]->getNumSeance() == 'S1') {
                // array_push($s1, new EmploiItem($seances[$i]->getJour(), $seanceDetail));
                switch ($seances[$i]->getJour()) {
                    case 'Lundi': $item1->setMonday($seanceDetail);break;
                    case 'Mardi': $item1->setTuesday($seanceDetail);break;
                    case 'Mercredi': $item1->setWednesday($seanceDetail);break;
                    case 'Jeudi': $item1->setThursday($seanceDetail);break;
                    case 'Vendredi': $item1->setFriday($seanceDetail);break;
                    case 'Samedi': $item1->setSaturday($seanceDetail);break;
                }
               // Monday, Tuesday, Wednesday, Thursday, Friday, Saturday,  Sunday
            }
            else if ($seances[$i]->getNumSeance() == 'S2'){
                // array_push($s1, new EmploiItem($seances[$i]->getJour(), $seanceDetail));
                switch ($seances[$i]->getJour()) {
                    case 'Lundi': $item2->setMonday($seanceDetail);break;
                    case 'Mardi': $item2->setTuesday($seanceDetail);break;
                    case 'Mercredi': $item2->setWednesday($seanceDetail);break;
                    case 'Jeudi': $item2->setThursday($seanceDetail);break;
                    case 'Vendredi': $item2->setFriday($seanceDetail);break;
                    case 'Samedi': $item2->setSaturday($seanceDetail);break;
                }
                // Monday, Tuesday, Wednesday, Thursday, Friday, Saturday,  Sunday
            }
            else if ($seances[$i]->getNumSeance() == 'S3'){
                // array_push($s1, new EmploiItem($seances[$i]->getJour(), $seanceDetail));
                switch ($seances[$i]->getJour()) {
                    case 'Lundi': $item3->setMonday($seanceDetail);break;
                    case 'Mardi': $item3->setTuesday($seanceDetail);break;
                    case 'Mercredi': $item3->setWednesday($seanceDetail);break;
                    case 'Jeudi': $item3->setThursday($seanceDetail);break;
                    case 'Vendredi': $item3->setFriday($seanceDetail);break;
                    case 'Samedi': $item3->setSaturday($seanceDetail);break;
                }
                // Monday, Tuesday, Wednesday, Thursday, Friday, Saturday,  Sunday
                // lundi + mardi + mercredi + jeudi + vendredi + samedi + dimanche.
            }
            else if ($seances[$i]->getNumSeance() =='S4'){
                // array_push($s1, new EmploiItem($seances[$i]->getJour(), $seanceDetail));
                switch ($seances[$i]->getJour()) {
                    case 'Lundi': $item4->setMonday($seanceDetail);break;
                    case 'Mardi': $item4->setTuesday($seanceDetail);break;
                    case 'Mercredi': $item4->setWednesday($seanceDetail);break;
                    case 'Jeudi': $item4->setThursday($seanceDetail);break;
                    case 'Vendredi': $item4->setFriday($seanceDetail);break;
                    case 'Samedi': $item4->setSaturday($seanceDetail);break;
                }
                // Monday, Tuesday, Wednesday, Thursday, Friday, Saturday,  Sunday
            }
        }
        $s = [$item1, $item2, $item3, $item4];

        $form=$this->createFormBuilder()->add('Niveau:',EntityType::class,
            array('class'=>'NiveauBundle\Entity\Niveau',
                'attr'=>array('label'=>'form-control', 'class'=>'form-control'),
                'choice_label'=>'label',
                'choice_value' => 'id',
                'expanded'=>false,
                'multiple'=>false,
                'placeholder' => 'Choisissez une Classe...',
            ))
            ->getForm();
        $form['Niveau:']->setData($niveau);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $niveauID=$form['Niveau:']->getData()->getID();
            return $this->redirectToRoute('emploi', array('id' => $niveauID));
        }
        return $this->render('EmploieBundle:pages:EmploiEtudiant.html.twig',[
                'form'=>$form->createView(),
                'S1'=>$s
            ]
        );
    }
}
