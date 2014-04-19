<?php

namespace site\reservationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use site\adminBundle\Entity\Vol;
use site\adminBundle\Entity\Reservation;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
    public function generatePDFAction($id = null){
        $em = $this->container->get('doctrine')->getEntityManager();
        $reservation = $em->find('siteadminBundle:reservation',$id);
        $userid = $this->get('security.context')->getToken()->getUser()->getId();
        if(!$reservation){
            throw new NotFoundHttpException("Reservation non trouvé");
        }
        if($reservation->getetat() != 'V'){
            throw new NotFoundHttpException("Reservation non trouvé");
        }
        $passager = $reservation->getPassager();
        //if($passager.getId() != $userid){
          //  throw new NotFoundHttpException("Utilisateur Non autorisé ");
        //}

        $facade = $this->get('ps_pdf.facade');
        $response = new Response();
        $this->render('sitereservationBundle:Default:ticket.pdf.twig',array(
            'reservation'=>$reservation
        ),$response);
        $xml = $response->getContent();

        $content = $facade->render($xml);

        return new Response($content, 200, array('content-type' => 'application/pdf'));
    }

}
