<?php
/**
 * Created by PhpStorm.
 * User: kh3dr0n
 * Date: 19/04/2014
 * Time: 20:27
 */

namespace site\adminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use site\adminBundle\Entity\Passager;

class PassagerController extends Controller {
        function listerAction(){
            $em = $this->container->get('doctrine')->getEntityManager();
            $passagers = $em->getRepository('siteadminBundle:passager')->FindAll();
            return $this->render('siteadminBundle:passager:lister.html.twig',array(
                'passagers'=>$passagers,
                'msg'=>''
            ));
        }


    function supprimerAction($id = null){
        $em = $this->container->get('doctrine')->getEntityManager();
        $passager = $em->find('siteadminBundle:passager',$id);
        if(!$passager){
            throw new NotFoundHttpException("Vol non trouvé");
        }
        $user = $em->find('siteadminBundle:user',$id);
        $em->remove($passager);
        $em->remove($user);
        $em->flush();
        return $this->redirect($this->generateUrl('siteadmin_personnel_lister'));
    }
    function modifierAction($id = null){

    }


    function ajouterAction(){
        return $this->container
            ->get('pugx_multi_user.registration_manager')
            ->register('site\adminBundle\Entity\Passager');
    }
} 