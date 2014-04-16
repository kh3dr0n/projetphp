<?php
/**
 * Created by PhpStorm.
 * User: kh3dr0n
 * Date: 16/04/2014
 * Time: 19:08
 */

namespace site\reservationBundle\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;

class PassagerForm extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom','text',array('attr'=>array('class'=>'form-control')))
            ->add('prenom','text',array('attr'=>array('class'=>'form-control')))
            ->add('sexe','choice', array('choices' => array('F'=>'Féminin','M'=>'Masculin'),'attr'=>array('class'=>'form-control input-sm mb15')))
            ->add('dateNaissance','birthday', array(
                'widget' => 'single_text',
                'format' => 'MM-dd-yyyy',
                'attr'=>array(
                    'class'=>'form-control',
                    'placeholder'=>'mm/dd/yyyy',
                )
            ))
        ;
    }

    public function getName()
    {
        return 'action';
    }
}