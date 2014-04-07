<?php
/**
 * Created by PhpStorm.
 * User: kh3dr0n
 * Date: 07/04/2014
 * Time: 08:53
 */

namespace site\adminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AvionController extends Controller{
    public function ListerAction(){
        return $this->render('siteadminBundle:Avion:lister.html.twig');
    }
} 