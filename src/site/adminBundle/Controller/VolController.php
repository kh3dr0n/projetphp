<?php
/**
 * Created by PhpStorm.
 * User: kh3dr0n
 * Date: 08/04/2014
 * Time: 09:16
 */

namespace site\adminBundle\Controller;

use site\adminBundle\Forms\AvionForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use site\adminBundle\Entity\Vol;

class VolController extends Controller{

    function listerAction(){
        $em = $this->container->get('doctrine')->getEntityManager();
        $vols = $em->getRepository('siteadminBundle:vol')->FindAll();



        return $this->render('siteadminBundle:vol:lister.html.twig',array(
            'vols'=>$vols,
            'msg'=>''
        ));
    }
    function ajouterAction(){

    }
    function modifierAction(){

    }
    function supprimerAction(){

    }
} 