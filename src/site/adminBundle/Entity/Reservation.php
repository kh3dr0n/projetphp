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
 * ORM\Entity
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
} 