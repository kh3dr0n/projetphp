<?php
/**
 * Created by PhpStorm.
 * User: kh3dr0n
 * Date: 07/04/2014
 * Time: 08:53
 */

namespace site\adminBundle\Controller;

use site\adminBundle\Forms\AvionForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use site\adminBundle\Entity\Avion;

class AvionController extends Controller{
    public function listerAction(){

        $em = $this->container->get('doctrine')->getEntityManager();
        $avions = $em->getRepository('siteadminBundle:avion')->FindAll();
        $vols = $em->getRepository('siteadminBundle:vol')->FindAll();



        foreach($avions as $a){
            $a->nbrvol = 0;
            foreach($vols as $v){
                if($v->getAvion()->getId() == $a->getId())
                    $a->nbrvol++;
            }
        }

        return $this->render('siteadminBundle:Avion:lister.html.twig',array(
            'avions'=>$avions,
            'msg'=>''
        ));
    }
    public function ajouterAction(){

        $msg = "";
        $avion = new Avion();
        $form = $this->container->get('form.factory')->create(new AvionForm(), $avion);
        $request = $this->container->get('request');
        if($request->getMethod() == "POST"){
            $form->bind($request);
            if($form->isValid()){
                $em = $this->container->get('doctrine')->getEntityManager();
                $em->persist($avion);
                $em->flush();

                return $this->redirect($this->generateUrl('siteadmin_avion_lister'));

            }
        }

        return $this->container->get('templating')->renderResponse('siteadminBundle:Avion:ajouter.html.twig',
            array(
                'form'=>$form->createView()

            )
        );
    }


    public function modifierAction($id = null){

        $msg = "";
        $em = $this->container->get('doctrine')->getEntityManager();


        if(isset($id)){
            $avion = $em->find('siteadminBundle:Avion', $id);

            if (!$avion)
            {
                $msg='Aucun avion trouvé';
            }

        }else{
            $avion = new Avion();
        }
        $form = $this->container->get('form.factory')->create(new AvionForm(), $avion);
        $request = $this->container->get('request');
        if($request->getMethod() == "POST"){
            $form->bind($request);
            if($form->isValid()){

                $em->persist($avion);
                $em->flush();

                return $this->redirect($this->generateUrl('siteadmin_avion_lister'));

            }
        }

        return $this->container->get('templating')->renderResponse('siteadminBundle:Avion:modifier.html.twig',
            array(
                'form'=>$form->createView()

            )
        );
    }
    function supprimerAction($id = null){
        $em = $this->container->get('doctrine')->getEntityManager();
        $avion = $em->find('siteadminBundle:Avion',$id);
        if(!$avion){
            throw new NotFoundHttpException("Acteur non trouvé");
        }

        $em->remove($avion);
        $em->flush();
        return $this->redirect($this->generateUrl('siteadmin_avion_lister'));
    }


} 