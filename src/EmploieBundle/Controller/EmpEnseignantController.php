<?php

namespace EmploieBundle\Controller;

use EmploieBundle\utils\EmploiItem;
use NiveauBundle\Entity\Niveau;
use SeancesBundle\Entity\Seance;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\User\UserInterface;

class EmpEnseignantController extends Controller
{
    public function empenseignantAction(UserInterface $user)
    {
        $n=$user->getId();
        $entityManager = $this->getDoctrine()->getManager();
        $niveau = $entityManager->getRepository(Niveau::class)->find($n);
        $seances  = $entityManager->getRepository(Seance::class)->findBy(array('prof' => $n));
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

        return $this->render('EmploieBundle:PagesEnseignant:empEnseignant.html.twig',[

                'S1'=>$s
            ]
        );



    }

}
