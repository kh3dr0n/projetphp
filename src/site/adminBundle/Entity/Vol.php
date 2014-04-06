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

} 