<?php

namespace site\reservationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use site\adminBundle\Entity\Vol;
use site\adminBundle\Entity\Reservation;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $nbvalide = 0;
        $em = $this->container->get('doctrine')->getEntityManager();
        $vols = $em->getRepository('siteadminBundle:vol')->FindAll();
        $csrfToken = $this->container->has('form.csrf_provider')
            ? $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate')
            : null;


        $securityContext = $this->container->get('security.context');
        if( $securityContext->isGranted('IS_AUTHENTICATED_FULLY') ){

            $userid = $this->get('security.context')->getToken()->getUser()->getId();
            $user = $em->find('siteadminBundle:Passager', $userid);
            $repo = $this->getDoctrine()->getRepository('siteadminBundle:Reservation');
            $nbvalide = count($repo->findBy(
                array('etat'=> 'V','passager'=> $user)
            ));
        }





        return $this->render('sitereservationBundle:Default:index.html.twig',
        array(
            'vols'=>$vols,
            'csrf_token'=>$csrfToken,
            'nbvalide'=>$nbvalide
        ));
    }
    public function reserverAction($id = null){

        $em = $this->container->get('doctrine')->getEntityManager();
        $vol = $em->find('siteadminBundle:Vol', $id);
        $userid = $this->get('security.context')->getToken()->getUser()->getId();

        $user = $em->find('siteadminBundle:Passager', $userid);





        $r = new Reservation();
        $r->setEtat('A');
        $r->setVol($vol);
        $r->setPassager($user);

        $em->persist($r);
        $em->flush();


       return $this->redirect($this->generateUrl('sitereservation_homepage'));

    }

    public function mesreservationAction(){
        $em = $this->container->get('doctrine')->getEntityManager();

        $r = $this->getDoctrine()->getRepository('siteadminBundle:Reservation');
        $userid = $this->get('security.context')->getToken()->getUser()->getId();

        $user = $em->find('siteadminBundle:Passager', $userid);

        $nbvalide = count($r->findBy(
            array('etat'=> 'V','passager'=> $user)
        ));

        $reservation = $r->findByPassager($user);
        return $this->render('sitereservationBundle:Default:mesreservations.html.twig',
            array(
                'vols'=>$reservation,
                'nbvalide'=>$nbvalide
            ));

    }

}
