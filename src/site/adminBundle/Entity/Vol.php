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
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     */
    private $date;
    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min="3")
     */
    private $destination;


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
}
