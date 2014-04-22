<?php

namespace site\adminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {


        $em = $this->container->get('doctrine')->getEntityManager();
        $vols = $em->getRepository('siteadminBundle:vol')->FindAll();
        $r = $this->getDoctrine()->getRepository('siteadminBundle:reservation');
        $vencour = 0;
        $place = 0;
        foreach($vols as $v){
            $place += (count($r->findByVol($v))/$v->getAvion()->getCapacite())*100;
            if($v->encour() == true){
                $vencour++;
            }
        }
        $place = $place/count($vols);

        $nbr=0;

        $nbr = count($r->findByEtat('A'));



        return $this->render('siteadminBundle:Default:index.html.twig',array(
            'volencour'=>$vencour,
            'place'=>$place,
            'nbr'=>$nbr
        ));
    }
}
