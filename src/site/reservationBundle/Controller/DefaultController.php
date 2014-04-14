<?php

namespace site\reservationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use site\adminBundle\Entity\Vol;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->container->get('doctrine')->getEntityManager();
        $vols = $em->getRepository('siteadminBundle:vol')->FindAll();


        return $this->render('sitereservationBundle:Default:index.html.twig',
        array(
            'vols'=>$vols
        ));
    }
    public function reserverAction(){
    return $this->render('sitereservationBundle:Default:reserver.html.twig');
    }
}
