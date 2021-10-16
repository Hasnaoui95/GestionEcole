<?php

namespace ExamenBundle\Controller;

use EmploieBundle\utils\EmploiItem;
use ExamenBundle\Entity\Examen;
use ExamenBundle\Form\ExamenType;
use NiveauBundle\Entity\Niveau;
use SeancesBundle\Entity\Seance;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use DateTime;
use Symfony\Component\Security\Core\User\UserInterface;


class ExamenController extends Controller
{
    public function createAction(Request $request)
    {
        $d=new \DateTime('11/06/2021');

       // $weekDay = date('w', '11/06/2021');
        $E = new Examen();
        $form=$this->createForm(ExamenType::class,$E);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em= $this->getDoctrine()->getManager();

            $dateExamen=$form['dateExamen']->getData();
           // $d = new \DateTime('Y-m-d H:i:s',$dateExamen);
            $stringValue = $dateExamen->format('Y-m-d H:i:s');
            //$obj = new DateTime($dateExamen);
            $E->setWeekDay(date('w',strtotime($stringValue)));

            $em->persist($E);
            $em->flush();
            return $this->redirectToRoute('ExamenCreate');
        }
        return $this->render('ExamenBundle:pages:create.html.twig',[
                'form'=>$form->createView()
            ]
        );


    }

    public function emploieExamenAction(UserInterface $user)
    {
        $n=$user->getId();
        $entityManager = $this->getDoctrine()->getManager();
        $niveau = $entityManager->getRepository(Niveau::class)->find($n);

        $examens  = $entityManager->getRepository(Examen::class)->findAll();
        $item1 = new EmploiItem();
        $item2 = new EmploiItem();
        $item3 = new EmploiItem();
        $item4 = new EmploiItem();
        for($i=0;$i<count($examens);$i++) {

            $examensDetail = 'Examen '.$examens[$i]->getMatiere()->getLibelle().'-'
                . ' ' . $examens[$i]->getSalle()->getLabel(). ' ' . $examens[$i]->getdateExamen()->format('d-m-Y')    ;

            if ($examens[$i]->getNumSeance() == 'S1') {
                // array_push($s1, new EmploiItem($seances[$i]->getJour(), $seanceDetail));
                switch ($examens[$i]->getWeekDay()) {
                    case '1': $item1->setMonday($examensDetail);break;
                    case '2': $item1->setTuesday($examensDetail);break;
                    case '3': $item1->setWednesday($examensDetail);break;
                    case '4': $item1->setThursday($examensDetail);break;
                    case '5': $item1->setFriday($examensDetail);break;
                    case '6': $item1->setSaturday($examensDetail);break;
                }
                // Monday, Tuesday, Wednesday, Thursday, Friday, Saturday,  Sunday
            }
            else if ($examens[$i]->getNumSeance() == 'S2'){
                // array_push($s1, new EmploiItem($seances[$i]->getJour(), $seanceDetail));
                switch ($examens[$i]->getWeekDay()) {
                    case '1': $item2->setMonday($examensDetail);break;
                    case '2': $item2->setTuesday($examensDetail);break;
                    case '3': $item2->setWednesday($examensDetail);break;
                    case '4': $item2->setThursday($examensDetail);break;
                    case '5': $item2->setFriday($examensDetail);break;
                    case '6': $item2->setSaturday($examensDetail);break;
                }
                // Monday, Tuesday, Wednesday, Thursday, Friday, Saturday,  Sunday
            }
            else if ($examens[$i]->getNumSeance() == 'S3'){
                // array_push($s1, new EmploiItem($seances[$i]->getJour(), $seanceDetail));
                switch ($examens[$i]->getWeekDay()) {
                    case '1': $item3->setMonday($examensDetail);break;
                    case '2': $item3->setTuesday($examensDetail);break;
                    case '3': $item3->setWednesday($examensDetail);break;
                    case '4': $item3->setThursday($examensDetail);break;
                    case '5': $item3->setFriday($examensDetail);break;
                    case '6': $item3->setSaturday($examensDetail);break;
                }
                // Monday, Tuesday, Wednesday, Thursday, Friday, Saturday,  Sunday
                // lundi + mardi + mercredi + jeudi + vendredi + samedi + dimanche.
            }
            else if ($examens[$i]->getNumSeance() =='S4'){
                // array_push($s1, new EmploiItem($seances[$i]->getJour(), $seanceDetail));
                switch ($examens[$i]->getWeekDay()) {
                    case '1': $item4->setMonday($examensDetail);break;
                    case '2': $item4->setTuesday($examensDetail);break;
                    case '3': $item4->setWednesday($examensDetail);break;
                    case '4': $item4->setThursday($examensDetail);break;
                    case '5': $item4->setFriday($examensDetail);break;
                    case '6': $item4->setSaturday($examensDetail);break;
                }
                // Monday, Tuesday, Wednesday, Thursday, Friday, Saturday,  Sunday
            }
        }
        $s = [$item1, $item2, $item3, $item4];

        return $this->render('ExamenBundle:pages:emploiExamen.html.twig',[

                'S1'=>$s
            ]
        );
    }

}
