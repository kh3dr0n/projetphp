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



    return $this->render('sitereservationBundle:Default:reserver.html.twig');
    }
}
