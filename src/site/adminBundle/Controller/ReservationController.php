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

} 