<?php
/**
 * Created by PhpStorm.
 * User: kh3dr0n
 * Date: 05/04/2014
 * Time: 19:07
 */

namespace site\adminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="admin")
 * @UniqueEntity(fields = "username", targetClass = "site\adminBundle\Entity\User", message="fos_user.username.already_used")
 * @UniqueEntity(fields = "email", targetClass = "site\adminBundle\Entity\User", message="fos_user.email.already_used")
 */
class Admin extends User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
