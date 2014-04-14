<?php
/**
 * Created by PhpStorm.
 * User: kh3dr0n
 * Date: 14/04/2014
 * Time: 06:55
 */

namespace site\reservationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LoginController extends Controller{
    function checkloginAction(){
        $user = $this->get('security.context')->getToken()->getUser();

        if(in_array("ROLE_ADMIN",$user->getRoles())){
            return $this->redirect($this->generateUrl('siteadmin_homepage'));
        }else{
            return $this->redirect($this->generateUrl('sitereservation_homepage'));
        }
    }
    function loginRediractionAction(){
        $key = '_security.main.target_path';
        if($this->container->get('session')->has($key))
             if(strpos($this->container->get('session')->get($key),"/admin")>-1){
                 return $this->redirect($this->generateUrl('fos_user_security_login'));
             }else{
            return $this->redirect($this->generateUrl('sitereservation_homepage'));
        }
    }
    function logoutAction(){
        return $this->redirect($this->generateUrl('fos_user_security_logout'));
    }
}