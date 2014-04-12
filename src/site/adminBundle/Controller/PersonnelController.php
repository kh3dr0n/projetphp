<?php
/**
 * Created by PhpStorm.
 * User: kh3dr0n
 * Date: 11/04/2014
 * Time: 22:00
 */

namespace site\adminBundle\Controller;


use site\adminBundle\Forms\AvionForm;
use site\adminBundle\Forms\PersonnelForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use site\adminBundle\Entity\Personnel;

class PersonnelController extends Controller{
    function listerAction(){
        $em = $this->container->get('doctrine')->getEntityManager();
        $personnel = $em->getRepository('siteadminBundle:personnel')->FindAll();
        return $this->render('siteadminBundle:personnel:lister.html.twig',array(
            'personnels'=>$personnel,
            'msg'=>''
        ));
    }


    function ajouterAction(){
        $msg = "";
        $personnel = new Personnel();
        $form = $this->container->get('form.factory')->create(new PersonnelForm(), $personnel);
        $request = $this->container->get('request');
        if($request->getMethod() == "POST"){
            $form->bind($request);
            if($form->isValid()){
                $em = $this->container->get('doctrine')->getEntityManager();
                $em->persist($personnel);
                $em->flush();

                return $this->redirect($this->generateUrl('siteadmin_personnel_lister'));

            }
        }

        return $this->container->get('templating')->renderResponse('siteadminBundle:personnel:ajouter.html.twig',
            array(
                'form'=>$form->createView()

            )
        );
    }
    function modifierAction($id = null){
        $msg = "";
        $em = $this->container->get('doctrine')->getEntityManager();

        if(isset($id)){
            $personnel = $em->find('siteadminBundle:Personnel', $id);

            if (!$personnel)
            {
                $msg='Aucun avion trouvé';
            }

        }else{
            $personnel = new Personnel();
        }


        $form = $this->container->get('form.factory')->create(new PersonnelForm(), $personnel);
        $request = $this->container->get('request');
        if($request->getMethod() == "POST"){
            $form->bind($request);
            if($form->isValid()){
                $em = $this->container->get('doctrine')->getEntityManager();
                $em->persist($personnel);
                $em->flush();

                return $this->redirect($this->generateUrl('siteadmin_personnel_lister'));

            }
        }

        return $this->container->get('templating')->renderResponse('siteadminBundle:personnel:modifier.html.twig',
            array(
                'form'=>$form->createView()

            )
        );

    }
    function supprimerAction($id = null){
        $em = $this->container->get('doctrine')->getEntityManager();
        $personnel = $em->find('siteadminBundle:personnel',$id);
        if(!$personnel){
            throw new NotFoundHttpException("Vol non trouvé");
        }

        $em->remove($personnel);
        $em->flush();
        return $this->redirect($this->generateUrl('siteadmin_personnel_lister'));

    }
} 