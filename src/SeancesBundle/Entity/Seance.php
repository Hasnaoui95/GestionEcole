<?php

namespace SeancesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use SalleBundle\Controller\DefaultController;
use SalleBundle\Entity\Salle;
use UserBundle\Entity\User;

/**
 * Seance
 *
 * @ORM\Table(name="seance")
 * @ORM\Entity(repositoryClass="SeancesBundle\Repository\SeanceRepository")
 */
class Seance
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
     * @ORM\Column(name="jour", type="string", length=255)
     */
    private $jour;

    /**
     * @var string
     *
     * @ORM\Column(name="num_seance", type="string", length=255)
     */
    private $numSeance;

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
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     */
    private $prof;


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
     * Set jour
     *
     * @param string $jour
     *
     * @return Seance
     */
    public function setJour($jour)
    {
        $this->jour = $jour;

        return $this;
    }

    /**
     * Get jour
     *
     * @return string
     */
    public function getJour()
    {
        return $this->jour;
    }

    /**
     * Set numSeance
     *
     * @param string $numSeance
     *
     * @return Seance
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

    /**
     * Set matiere
     *
     * @param Matiere $matiere
     *
     * @return Seance
     */
    public function setMatiere($matiere)
    {
        $this->matiere = $matiere;

        return $this;
    }

    /**
     * Get matiere
     *
     * @return Matiere
     */
    public function getMatiere()
    {
        return $this->matiere;
    }

    /**
     * Set clasee
     *
     * @param Niveau $classe
     *
     * @return Seance
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * Get classe
     *
     * @return Niveau
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * Set prof
     *
     * @param User $prof
     *
     * @return Seance
     */
    public function setProf($prof)
    {
        $this->prof = $prof;

        return $this;
    }

    /**
     * Get prof
     *
     * @return User
     */
    public function getProf()
    {
        return $this->prof;}


    /**
     * Set salle
     *
     * @param Salle $salle
     *
     * @return Seance
     */
    public function setSalle($salle)
    {
        $this->salle = $salle;

        return $this;
    }

    /**
     * Get salle
     *
     * @return Salle
     */
    public function getSalle()
    {
        return $this->salle;
    }


}


