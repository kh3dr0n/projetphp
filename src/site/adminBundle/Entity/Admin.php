<?php
/**
 * Created by PhpStorm.
 * User: kh3dr0n
 * Date: 05/04/2014
 * Time: 19:07
 */

namespace site\adminBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class Admin extends BaseUser{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
}
