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
} 