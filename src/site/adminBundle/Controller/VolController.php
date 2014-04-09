<?php
/**
 * Created by PhpStorm.
 * User: kh3dr0n
 * Date: 08/04/2014
 * Time: 09:16
 */

namespace site\adminBundle\Controller;

use site\adminBundle\Forms\VolForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use site\adminBundle\Entity\Vol;

class VolController extends Controller{

    function listerAction(){
        $em = $this->container->get('doctrine')->getEntityManager();
        $vols = $em->getRepository('siteadminBundle:vol')->FindAll();



        return $this->render('siteadminBundle:vol:list.html.twig',array(
            'vols'=>$vols
        ));
    }
    function ajouterAction(){
        $msg = "";
        $vol = new vol();
        $form = $this->container->get('form.factory')->create(new VolForm(), $vol);
        $request = $this->container->get('request');
        if($request->getMethod() == "POST"){
            $form->bind($request);
            if($form->isValid()){
                $em = $this->container->get('doctrine')->getEntityManager();
                $em->persist($vol);
                $em->flush();

                return $this->redirect($this->generateUrl('siteadmin_vol_lister'));

            }
        }

        return $this->container->get('templating')->renderResponse('siteadminBundle:vol:ajouter.html.twig',
            array(
                'form'=>$form->createView()

            )
        );

    }
    function modifierAction(){

    }
    function supprimerAction(){

    }
} 