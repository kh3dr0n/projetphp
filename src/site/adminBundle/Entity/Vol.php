<?php
/**
 * Created by PhpStorm.
 * User: kh3dr0n
 * Date: 05/04/2014
 * Time: 18:42
 */

namespace site\adminBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity
 */
class Vol {
    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Avion")
     * @Assert\NotBlank()
     */
    private $Avion;
    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank()
     */
    private $date;
    /**
     * @ORM\Column(type="time")
     * @Assert\NotBlank()
     */
    private $heure;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $duree;
    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min="3")
     */
    private $destination;

    /**
     * @ORM\Column(type="string",length=1)
     * @Assert\Choice(choices = {"A", "R","C","-"})
     */
    private $etat;
    /**
     * @ORM\ManyToMany(targetEntity="Personnel")
     */
    private $personnel;





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
     * Set date
     *
     * @param \DateTime $date
     * @return Vol
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set destination
     *
     * @param string $destination
     * @return Vol
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Get destination
     *
     * @return string 
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Set Avion
     *
     * @param \site\adminBundle\Entity\Avion $avion
     * @return Vol
     */
    public function setAvion(\site\adminBundle\Entity\Avion $avion = null)
    {
        $this->Avion = $avion;

        return $this;
    }

    /**
     * Get Avion
     *
     * @return \site\adminBundle\Entity\Avion 
     */
    public function getAvion()
    {
        return $this->Avion;
    }

    /**
     * Set duree
     *
     * @param integer $duree
     * @return Vol
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return integer 
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set heure
     *
     * @param \DateTime $heure
     * @return Vol
     */
    public function setHeure($heure)
    {
        $this->heure = $heure;

        return $this;
    }

    /**
     * Get heure
     *
     * @return \DateTime 
     */
    public function getHeure()
    {
        return $this->heure;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->personnel = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add personnel
     *
     * @param \site\adminBundle\Entity\Personnel $personnel
     * @return Vol
     */
    public function addPersonnel(\site\adminBundle\Entity\Personnel $personnel)
    {
        $this->personnel[] = $personnel;

        return $this;
    }

    /**
     * Remove personnel
     *
     * @param \site\adminBundle\Entity\Personnel $personnel
     */
    public function removePersonnel(\site\adminBundle\Entity\Personnel $personnel)
    {
        $this->personnel->removeElement($personnel);
    }

    /**
     * Get personnel
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPersonnel()
    {
        return $this->personnel;
    }


    /**
     * Set etat
     *
     * @param string $etat
     * @return Vol
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


    public function encour(){
        $now = time();
        $d = $this->getDate()->format('Y-m-d').' '.$this->getHeure()->format("H:i");
        $start = strtotime($d) + 3600;
        $end = $start + $this->getDuree()*60;
        //echo $start,' ',$now,' ',$end,'<br>';
        //echo $d;
        return $now >= $start && $now <= $end;
    }

    public function personnelIsValid(){
        //{"Commandant du bord", "Copilote", "Stewart", "Hôtesse"})
        $cb = false;
        $copilote = false;
        $stewart = false;
        $hotesse = false;
        foreach($this->personnel as $p){
            switch($p->getposte()){
                case'Commandant du bord':
                    $cb = true;
                    break;
                case'Copilote':
                    $copilote = true;
                    break;
                case 'Stewart':
                    $stewart = true;
                    break;
                case 'Hôtesse':
                    $hotesse = true;
                    break;
            }
            if($cb && $copilote && $stewart && $hotesse)
                return true;
        }
        return $cb && $copilote && $stewart && $hotesse;
    }

}
