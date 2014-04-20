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
use Ps\PdfBundle\Annotation\Pdf;
use Symfony\Component\HttpFoundation\Response;

class VolController extends Controller{

    function listerAction(){
        $em = $this->container->get('doctrine')->getEntityManager();
        $vols = $em->getRepository('siteadminBundle:vol')->FindAll();
        $r = $this->getDoctrine()->getRepository('siteadminBundle:reservation');
        foreach($vols as $a){
            $a->reservation = (string)count($r->findByVol($a)).'/'.(string)$a->getAvion()->getCapacite();
        }

        return $this->render('siteadminBundle:vol:lister.html.twig',array(
            'vols'=>$vols,
            'msg'=>''
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
    function modifierAction($id = null){
        $msg = "";
        $em = $this->container->get('doctrine')->getEntityManager();

        if(isset($id)){
            $vol = $em->find('siteadminBundle:Vol', $id);

            if (!$vol)
            {
                $msg='Aucun avion trouvé';
            }

        }else{
            $vol = new Vol();
        }


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

        return $this->container->get('templating')->renderResponse('siteadminBundle:vol:modifier.html.twig',
            array(
                'form'=>$form->createView()

            )
        );

    }
    function supprimerAction($id = null){
        $em = $this->container->get('doctrine')->getEntityManager();
        $vol = $em->find('siteadminBundle:vol',$id);
        if(!$vol){
            throw new NotFoundHttpException("Vol non trouvé");
        }

        $em->remove($vol);
        $em->flush();
        return $this->redirect($this->generateUrl('siteadmin_vol_lister'));

    }
    function changeEtatAction($id = null,$etat =null){
        $em = $this->container->get('doctrine')->getEntityManager();
        $vol = $em->find('siteadminBundle:vol',$id);
        if(!$vol){
            throw new NotFoundHttpException("Vol non trouvé");
        }
        $vol->setEtat($etat);
        $em->persist($vol);
        $em->flush();
        return $this->redirect($this->generateUrl('siteadmin_vol_lister'));

    }





    /**
     * @Pdf()
     */
    function generatePdfAction($id = null){

        $em = $this->container->get('doctrine')->getEntityManager();
        $vol = $em->find('siteadminBundle:vol',$id);
        if(!$vol){
            throw new NotFoundHttpException("Vol non trouvé");
        }


        $facade = $this->get('ps_pdf.facade');
        $response = new Response();
        $this->render('siteadminBundle:vol:vol.pdf.twig',array(
            'vol'=>$vol
        ),$response);
        $xml = $response->getContent();

        $content = $facade->render($xml);

        return new Response($content, 200, array('content-type' => 'application/pdf'));
    }
} 