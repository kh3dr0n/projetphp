<?php
/**
 * Created by PhpStorm.
 * User: kh3dr0n
 * Date: 12/04/2014
 * Time: 18:37
 */

namespace site\adminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class Reservation {
    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="Passager")
     * @Assert\NotBlank()
     */
    private $passager;
    /**
     * @ORM\ManyToOne(targetEntity="Vol")
     * @Assert\NotBlank()
     */
    private $vol;
    /**
     * @ORM\Column(type="string",length=1)
     * @Assert\NotBlank()
     * @Assert\Choice(choices = {"A", "V","R"})
     */
    private $etat;

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
     * Set etat
     *
     * @param string $etat
     * @return Reservation
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string 
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set passager
     *
     * @param \site\adminBundle\Entity\User $passager
     * @return Reservation
     */
    public function setPassager(\site\adminBundle\Entity\User $passager = null)
    {
        $this->passager = $passager;

        return $this;
    }

    /**
     * Get passager
     *
     * @return \site\adminBundle\Entity\User 
     */
    public function getPassager()
    {
        return $this->passager;
    }

    /**
     * Set vol
     *
     * @param \site\adminBundle\Entity\Vol $vol
     * @return Reservation
     */
    public function setVol(\site\adminBundle\Entity\Vol $vol = null)
    {
        $this->vol = $vol;

        return $this;
    }

    /**
     * Get vol
     *
     * @return \site\adminBundle\Entity\Vol 
     */
    public function getVol()
    {
        return $this->vol;
    }
    public function getEtatstring(){
        switch($this->etat){
            case 'A':
                return 'Attente';
                break;
            case 'V':
                return 'Validée';
            case 'R':
                return 'Refuséé';
        }
    }
}
