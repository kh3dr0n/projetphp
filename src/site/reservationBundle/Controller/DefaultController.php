<?php

namespace site\reservationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use site\adminBundle\Entity\Vol;
use site\adminBundle\Entity\Reservation;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->container->get('doctrine')->getEntityManager();
        $vols = $em->getRepository('siteadminBundle:vol')->FindAll();
        $csrfToken = $this->container->has('form.csrf_provider')
            ? $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate')
            : null;

        return $this->render('sitereservationBundle:Default:index.html.twig',
        array(
            'vols'=>$vols,
            'csrf_token'=>$csrfToken
        ));
    }
    public function reserverAction($id = null){

        $em = $this->container->get('doctrine')->getEntityManager();
        $vol = $em->find('siteadminBundle:Vol', $id);
        $userid = $this->get('security.context')->getToken()->getUser()->getId();
        $user = $em->find('siteadminBundle:User', $userid);

        $r = new Reservation();
        $r->setEtat('A');
        $r->setVol($vol);
        $r->setPassager($user);

        $em->persist($r);
        $em->flush();


        return $this->redirect($this->generateUrl('sitereservation_homepage'));

    //return $this->render('sitereservationBundle:Default:reserver.html.twig');
    }
}
