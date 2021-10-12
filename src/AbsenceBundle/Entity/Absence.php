<?php

namespace AbsenceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use SeancesBundle\Entity\Seance;
use UserBundle\Entity\User;

/**
 * Absence
 *
 * @ORM\Table(name="absence")
 * @ORM\Entity(repositoryClass="AbsenceBundle\Repository\AbsenceRepository")
 */
class Absence
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
     * @ORM\Column(name="statut", type="string", length=255)
     */
    private $statut;

    /**
     * @var Seance
     *
     * @ORM\ManyToOne(targetEntity="SeancesBundle\Entity\Seance")
     */
    private $seance;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     */
    private $etudiant;

    /**
     * @return Seance
     */
    public function getSeance()
    {
        return $this->seance;
    }

    /**
     * @param Seance $seance
     */
    public function setSeance(Seance $seance)
    {
        $this->seance = $seance;
    }

    /**
     * Set etudiant
     *
     * @param User $etudiant
     *
     * @return Seance
     */
    public function setEtudiant($etudiant)
    {
        $this->etudiant = $etudiant;

        return $this;
    }

    /**
     * Get etudiant
     *
     * @return User
     */
    public function getEtudiant()
    {
        return $this->etudiant;}


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
     * Set statut
     *
     * @param string $statut
     *
     * @return Absence
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }
}

