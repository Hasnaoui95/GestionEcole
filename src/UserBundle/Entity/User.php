<?php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use SeancesBundle\Entity\Seance;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User  extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="Prenom", type="string", length=255)
     */
    private $prenom;

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
     * @var Role
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Role")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Role;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom(string $prenom)
    {
        $this->prenom = $prenom;
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
     * @return Role
     */
    public function getRole()
    {
        return $this->Role;
    }

    /**
     * @param Role $Role
     * @return User
     */
    public function setRole(Role $Role): User
    {
        $this->Role = $Role;
        return $this;
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


    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
    public function getNomPrenom()
    {

        return $this->getNom().' '.$this->getPrenom();
    }
}

