<?php
/**
 * Created by PhpStorm.
 * User: kh3dr0n
 * Date: 14/04/2014
 * Time: 20:28
 */

namespace site\adminBundle\Controller;

use site\adminBundle\Forms\VolForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class ReservationController extends Controller{
    function listerAction(){
        $em = $this->container->get('doctrine')->getEntityManager();
        $reservations = $em->getRepository('siteadminBundle:reservation')->FindAll();


        return $this->render('siteadminBundle:reservation:lister.html.twig',array(
            'reservations'=>$reservations,
            'msg'=>''
        ));
    }


    function accepterAction($id = null){

        $em = $this->container->get('doctrine')->getEntityManager();
        $r = $em->find('siteadminBundle:Reservation', $id);
        $r->setEtat('V');
        $em->persist($r);
        $em->flush();
        return $this->redirect($this->generateUrl('siteadmin_reservation_lister'));
    }

    function refuserAction($id = null){

        $em = $this->container->get('doctrine')->getEntityManager();
        $r = $em->find('siteadminBundle:Reservation', $id);
        $r->setEtat('R');
        $em->persist($r);
        $em->flush();
        return $this->redirect($this->generateUrl('siteadmin_reservation_lister'));

    }
    public function supprimerAction($id = null){
        $em = $this->container->get('doctrine')->getEntityManager();
        $r= $em->find('siteadminBundle:Reservation',$id);
        if(!$r){
            throw new NotFoundHttpException("Reservation non trouvé");
        }
        $em->remove($r);
        $em->flush();
        return $this->redirect($this->generateUrl('siteadmin_reservation_lister'));

    }
} 