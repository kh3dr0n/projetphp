<?php

namespace site\adminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('siteadminBundle:Default:index.html.twig');
    }
}
