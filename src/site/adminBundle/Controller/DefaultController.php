<?php

namespace site\adminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {

//
//        $discriminator = $this->container->get('pugx_user.manager.user_discriminator');
//        $discriminator->setClass('site\adminBundle\Entity\Admin');
//
//        $userManager = $this->container->get('pugx_user_manager');
//
//        $userOne = $userManager->createUser();
//
//        $userOne->setUsername('admin');
//        $userOne->setEmail('admin@mail.com');
//        $userOne->setPlainPassword('admin');
//        $userOne->setEnabled(true);
//        $userOne->addRole('ROLE_ADMIN');
//
//        $userManager->updateUser($userOne, true);
//
//        $userOne = $userManager->createUser();
//        $userOne->setUsername('passager');
//        $userOne->setEmail('user@mail.com');
//        $userOne->setPlainPassword('user');
//        $userOne->setEnabled(true);
//
//        $userManager->updateUser($userOne, true);


        return $this->render('siteadminBundle:Default:index.html.twig');
    }
}
