<?php

namespace site\adminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {


        $em = $this->container->get('doctrine')->getEntityManager();
        $vols = $em->getRepository('siteadminBundle:vol')->FindAll();
        $r = $this->getDoctrine()->getRepository('siteadminBundle:reservation');
        $vencour = 0;
        $place = 0;
        foreach($vols as $v){
            $place += (count($r->findByVol($v))/$v->getAvion()->getCapacite())*100;
            if($v->encour() == true){
                $vencour++;
            }
        }
        $place = $place/count($vols);


//
//        $discriminator = $this->container->get('pugx_user.manager.user_discriminator');
//        $discriminator->setClass('site\adminBundle\Entity\Passager');
//
//        $userManager = $this->container->get('pugx_user_manager');
//
//        $userOne = $userManager->createUser();
//
//        $userOne->setUsername('test');
//        $userOne->setEmail('testr@mail.com');
//
//        $userOne->setNom('Nom');
//        $userOne->setPrenom('Prenom');
//        $userOne->setSexe('M');
//        $userOne->setDateNaissance(new \DateTime('01-01-1990'));
//
//        $userOne->setPlainPassword('test');
//        $userOne->setEnabled(true);
//        $userOne->addRole('ROLE_PASSAGER');
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


        return $this->render('siteadminBundle:Default:index.html.twig',array(
            'volencour'=>$vencour,
            'place'=>$place
        ));
    }
}
