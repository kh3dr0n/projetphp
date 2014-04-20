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







        $request = $this->container->get('request');
        if($request->getMethod() == "POST"){
            $nom = $request->request->get('nom');
            $prenom = $request->request->get('nom');
            $sexe = $request->request->get('sexe');
            $dn = $request->request->get('dateNaissance');
            $username = $request->request->get('username');
            $email = $request->request->get('email');
            $password = $request->request->get('password');



                    $discriminator = $this->container->get('pugx_user.manager.user_discriminator');
                    $discriminator->setClass('site\adminBundle\Entity\Passager');

                    $userManager = $this->container->get('pugx_user_manager');

                    $userOne = $userManager->createUser();

                    $userOne->setUsername($username);
                    $userOne->setEmail($email);

                    $userOne->setNom($nom);
                    $userOne->setPrenom($prenom);
                    $userOne->setSexe($sexe);
                    $userOne->setDateNaissance(new \DateTime($dn));

                    $userOne->setPlainPassword($password);
                    $userOne->setEnabled(true);
                    $userOne->addRole('ROLE_PASSAGER');

                    $userManager->updateUser($userOne, true);

        }

        return $this->render('siteadminBundle:passager:ajouter.html.twig');
    }
} 