<?php
/**
 * Created by PhpStorm.
 * User: kh3dr0n
 * Date: 16/04/2014
 * Time: 18:54
 */

namespace site\reservationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use site\reservationBundle\Forms\PassagerForm;
use site\adminBundle\Entity\Passager;

class ProfileController extends Controller{
    function profileAction(){
        $em = $this->container->get('doctrine')->getEntityManager();

        $r = $this->getDoctrine()->getRepository('siteadminBundle:Reservation');
        $userid = $this->get('security.context')->getToken()->getUser()->getId();

        $user = $em->find('siteadminBundle:Passager', $userid);

        $nbvalide = count($r->findBy(
            array('etat'=> 'V','passager'=> $user)
        ));



        $form = $this->container->get('form.factory')->create(new PassagerForm(), $user);
        $request = $this->container->get('request');
        if($request->getMethod() == "POST"){
            $form->bind($request);
            if($form->isValid()){
                $em = $this->container->get('doctrine')->getEntityManager();
                $em->persist($user);
                $em->flush();

                //return $this->redirect($this->generateUrl('siteadmin_personnel_lister'));

            }
        }


        return $this->render('sitereservationBundle:Default:profil.html.twig',
        array(
            'nbvalide'=>$nbvalide,
            'form'=>$form->createView()
        ));
    }
}