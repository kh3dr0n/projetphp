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


        $rrepo = $em->getRepository('siteadminBundle:reservation');
        $reservations = $rrepo->findby(array('passager'=>$passager));
        foreach($reservations as $r ){
            $em->remove($r);
        }
        $em->remove($passager);
        $em->remove($user);
        $em->flush();
        return $this->redirect($this->generateUrl('siteadmin_passager_lister'));
    }
    function modifierAction($id = null){
        $request = $this->container->get('request');
        $em = $this->container->get('doctrine')->getEntityManager();
        $user = $em->find('siteadminBundle:user',$id);
        $username = $user->getUsername();


        $discriminator = $this->container->get('pugx_user.manager.user_discriminator');
        $discriminator->setClass('site\adminBundle\Entity\Passager');

        $userManager = $this->container->get('pugx_user_manager');

        $userOne = $userManager->findUserByUsername($username);




        $nomvalue = $userOne->getNom();
        $prenomvalue = $userOne->getPrenom();
        $sexevalue = $userOne->getSexe();
        $dnvalue = $userOne->getDateNaissance()->format('m/d/Y');




        $request = $this->container->get('request');
        if($request->getMethod() == "POST"){

            $nom = $request->request->get('nom');
            $prenom = $request->request->get('prenom');
            $sexe = $request->request->get('sexe');
            $dn = $request->request->get('dateNaissance');
            $password = $request->request->get('password');
            $userOne->setNom($nom);
            $userOne->setPrenom($prenom);
            $userOne->setSexe($sexe);
            $userOne->setDateNaissance(new \DateTime($dn));
            if($password != '')
                $userOne->setPlainPassword($password);

            //$userOne->setEnabled(true);
            //$userOne->addRole('ROLE_PASSAGER');

            $userManager->updateUser($userOne, true);


            return $this->redirect($this->generateUrl('siteadmin_passager_lister'));

        }

        return $this->render('siteadminBundle:passager:modifier.html.twig',array(
            'nom'=>$nomvalue,
            'prenom'=>$prenomvalue,
            'dn'=>$dnvalue,
            'sexe'=>$sexevalue
        ));
    }


    function ajouterAction(){
        $request = $this->container->get('request');
        if($request->getMethod() == "POST"){
            $nom = $request->request->get('nom');
            $prenom = $request->request->get('prenom');
            $sexe = $request->request->get('sexe');
            $dn = $request->request->get('dateNaissance');
            $username = $request->request->get('username');
            $email = $request->request->get('email');
            $password = $request->request->get('password');



                    $discriminator = $this->container->get('pugx_user.manager.user_discriminator');
                    $discriminator->setClass('site\adminBundle\Entity\Passager');

                    $userManager = $this->container->get('pugx_user_manager');

                    if($userManager->findUserByUsername($username))
                        return $this->render('siteadminBundle:passager:ajouter.html.twig',array(
                            'msg'=>'Nom utilisateur existe'
                        ));
                    if($userManager->findUserByEmail($email))
                        return $this->render('siteadminBundle:passager:ajouter.html.twig',array(
                            'msg'=>'Email existe'
                        ));

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


            return $this->redirect($this->generateUrl('siteadmin_personnel_lister'));

        }

        return $this->render('siteadminBundle:passager:ajouter.html.twig',array(
            'msg'=>''
        ));
    }
} 