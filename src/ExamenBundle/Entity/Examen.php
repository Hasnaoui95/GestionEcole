<?php

namespace ExamenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use SalleBundle\Entity\Salle;
use MatiereBundle\Entity\Matiere;
use NiveauBundle\Entity\Niveau;
use DateTime;


/**
 * Examen
 *
 * @ORM\Table(name="examen")
 * @ORM\Entity(repositoryClass="ExamenBundle\Repository\ExamenRepository")
 */
class Examen
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var string
     *
     * @ORM\Column(name="numSeance", type="string", length=255)
     */
    private $numSeance;

    /**
     * @var string
     *
     * @ORM\Column(name="weekDay", type="string", length=255)
     */
    private $weekDay;

    /**
     * @var date
     *
     * @ORM\Column(name="dateExamen",type="datetime")
     */
    private $dateExamen;

    /**
     * @var Matiere
     *
     * @ORM\ManyToOne(targetEntity="MatiereBundle\Entity\Matiere")
     */
    private $matiere;

    /**
     * @var Niveau
     *
     * @ORM\ManyToOne(targetEntity="NiveauBundle\Entity\Niveau")
     */
    private $classe;

    /**
     * @var Salle
     *
     * @ORM\ManyToOne(targetEntity="SalleBundle\Entity\Salle")
     */
    private $salle;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Matiere
     */
    public function getMatiere()
    {
        return $this->matiere;
    }

    /**
     * @param Matiere $matiere
     */
    public function setMatiere(Matiere $matiere)
    {
        $this->matiere = $matiere;
    }

    /**
     * @return string
     */
    public function getWeekDay()
    {
        return $this->weekDay;
    }

    /**
     * @param string $weekDay
     */
    public function setWeekDay(string $weekDay)
    {
        $this->weekDay = $weekDay;
    }


    /**
     * @return Niveau
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * @param Niveau $classe
     */
    public function setClasse(Niveau $classe)
    {
        $this->classe = $classe;
    }

    /**
     * @return date
     */
    public function getDateExamen()
    {
        return $this->dateExamen;
    }

    /**
     * @param date $dateExamen
     */
    public function setDateExamen(\DateTime $dateExamen)
    {
        $this->dateExamen = $dateExamen;
    }



    /**
     * @return Salle
     */
    public function getSalle()
    {
        return $this->salle;
    }

    /**
     * @param Salle $salle
     */
    public function setSalle(Salle $salle)
    {
        $this->salle = $salle;
    }

    /**
     * Set numSeance
     *
     * @param string $numSeance
     *
     * @return Examen
     */
    public function setNumSeance($numSeance)
    {
        $this->numSeance = $numSeance;

        return $this;
    }

    /**
     * Get numSeance
     *
     * @return string
     */
    public function getNumSeance()
    {
        return $this->numSeance;
    }
}

