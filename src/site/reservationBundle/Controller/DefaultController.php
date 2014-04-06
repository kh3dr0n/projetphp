<?php

namespace site\reservationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('sitereservationBundle:Default:index.html.twig', array('name' => $name));
    }
}
