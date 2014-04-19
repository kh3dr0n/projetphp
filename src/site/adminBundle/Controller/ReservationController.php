<?php
/**
 * Created by PhpStorm.
 * User: kh3dr0n
 * Date: 14/04/2014
 * Time: 20:28
 */

namespace site\adminBundle\Controller;

use site\adminBundle\Forms\VolForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ReservationController extends Controller{
    function listerAction(){
        $em = $this->container->get('doctrine')->getEntityManager();
        $reservations = $em->getRepository('siteadminBundle:reservation')->FindAll();


        return $this->render('siteadminBundle:reservation:lister.html.twig',array(
            'reservations'=>$reservations,
            'msg'=>''
        ));
    }


    function accepterAction($id = null){

        $em = $this->container->get('doctrine')->getEntityManager();
        $r = $em->find('siteadminBundle:Reservation', $id);
        $r->setEtat('V');
        $em->persist($r);
        $em->flush();
        return $this->redirect($this->generateUrl('siteadmin_reservation_lister'));
    }

    function refuserAction($id = null){

        $em = $this->container->get('doctrine')->getEntityManager();
        $r = $em->find('siteadminBundle:Reservation', $id);
        $r->setEtat('R');
        $em->persist($r);
        $em->flush();
        return $this->redirect($this->generateUrl('siteadmin_reservation_lister'));

    }
    public function supprimerAction($id = null){
        $em = $this->container->get('doctrine')->getEntityManager();
        $r= $em->find('siteadminBundle:Reservation',$id);
        if(!$r){
            throw new NotFoundHttpException("Reservation non trouvé");
        }
        $em->remove($r);
        $em->flush();
        return $this->redirect($this->generateUrl('siteadmin_reservation_lister'));

    }
    public function exporterAction(){
        $em = $this->container->get('doctrine')->getEntityManager();
        $vols = $em->getRepository('siteadminBundle:vol')->FindAll();


        return $this->render('siteadminBundle:reservation:exporter.html.twig',array(
            'vols'=>$vols
        ));
    }


    public function exportexcelAction(){

        $request = Request::createFromGlobals();

        $em = $this->container->get('doctrine')->getEntityManager();
        $repo = $em->getRepository('siteadminBundle:Reservation');
        $date = $request->request->get('date','');
        $vol = $request->request->get('vol','');
        $destination = $request->request->get('destination','');

        if($vol != ''){
            $v= $em->find('siteadminBundle:vol',$vol);
            $reservations = $repo->findByVol($v);
        }else{
            $reservations = $repo->findAll();
        }

        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();

        $phpExcelObject->getProperties()->setCreator("Airena")
            ->setLastModifiedBy("Giulio De Donato")
            ->setTitle("Airena Export File")
            ->setSubject("Airena Export file");


        $phpExcelObject->setActiveSheetIndex(0)
            ->setCellValue('A1','id')
            ->setCellValue('B1','Nom')
            ->setCellValue('C1','Prenom')
            ->setCellValue('D1','Sexe')
            ->setCellValue('E1','Date')
            ->setCellValue('F1','Duree')
            ->setCellValue('G1','Destination')
            ->setCellValue('H1','Avion ID');

        $i = 2;
        foreach($reservations as $r){
                if( (($date != '' && $r->getVol()->getDate()->format('m/d/Y')== $date) || $date == '') && (($destination != '' && $r->getVol()->getDestination()==$destination)|| $destination == '' ) && $r->getEtat() == 'V'){

                $phpExcelObject->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $r->getId())
                    ->setCellValue('B'.$i, $r->getPassager()->getNom())
                    ->setCellValue('C'.$i, $r->getPassager()->getPrenom())
                    ->setCellValue('D'.$i, $r->getPassager()->getSexe())
                    ->setCellValue('E'.$i, $r->getVol()->getDate()->format('m-d-Y'))
                    ->setCellValue('F'.$i, $r->getVol()->getDuree())
                    ->setCellValue('G'.$i, $r->getVol()->getDestination())
                    ->setCellValue('H'.$i, $r->getVol()->getAvion()->getId());
                $i = $i + 1;
            }
        }




        $phpExcelObject->getActiveSheet()->setTitle('Simple');




        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment;filename=AirenaExport.xls');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');

       return $response;




    }
} 