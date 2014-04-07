<?php
/**
 * Created by PhpStorm.
 * User: kh3dr0n
 * Date: 05/04/2014
 * Time: 18:33
 */

namespace site\adminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class Personnel {
    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min="3")
     */
    private $nom;

    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min="3")
     */
    private $prenom;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank()
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="string",length=1)
     * @Assert\NotBlank()
     * @Assert\Choice(choices = {"M", "F"})
     */
    private $sexe;
    /**
     * @ORM\Column(type="string",length=20)
     * @Assert\NotBlank()
     * @Assert\Choice(choices = {"Commandant du bord", "Copilote", "Stewart", "Hôtesse"})
     */
    private $poste;

    /**
     * @ORM\ManyToMany(targetEntity="Vol")
     */
    private $vol;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->vol = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Personnel
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return Personnel
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     * @return Personnel
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime 
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     * @return Personnel
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string 
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set poste
     *
     * @param string $poste
     * @return Personnel
     */
    public function setPoste($poste)
    {
        $this->poste = $poste;

        return $this;
    }

    /**
     * Get poste
     *
     * @return string 
     */
    public function getPoste()
    {
        return $this->poste;
    }

    /**
     * Add vol
     *
     * @param \site\adminBundle\Entity\Vol $vol
     * @return Personnel
     */
    public function addVol(\site\adminBundle\Entity\Vol $vol)
    {
        $this->vol[] = $vol;

        return $this;
    }

    /**
     * Remove vol
     *
     * @param \site\adminBundle\Entity\Vol $vol
     */
    public function removeVol(\site\adminBundle\Entity\Vol $vol)
    {
        $this->vol->removeElement($vol);
    }

    /**
     * Get vol
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVol()
    {
        return $this->vol;
    }
}
