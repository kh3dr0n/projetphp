<?php
/**
 * Created by PhpStorm.
 * User: kh3dr0n
 * Date: 09/04/2014
 * Time: 10:36
 */

namespace site\adminBundle\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;

class VolForm extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('avion', 'entity', array(
                'class' => 'siteadminBundle:Avion',
                //'property' => 'id',
                'attr' => array(
                    'class'=>'form-control input-sm mb15'

                )
            ))
            ->add('date', 'date', array(
                'widget' => 'single_text',
                'format' => 'MM-dd-yyyy',
                'attr'=>array(
                    'class'=>'form-control',
                    'placeholder'=>'mm/dd/yyyy',
                )
            ))
            ->add('heure', 'time', array(
                'widget' => 'single_text',
                'attr'=>array(
                    'id'=>'timepicker',
                    'class'=>'form-control'
                )
            ))
            ->add('duree','text',array(
                'attr'=>array(
                    'class'=>'form-control'
                )
            ))
            ->add('destination')
            ->add('etat','hidden',array(
                'data'=>'-'
            ))
            ->add('personnel','entity',array(
                'class'    => 'siteadminBundle:Personnel',
                'expanded' => false ,
                'multiple' => true ,
                'group_by' => 'poste',
                'attr'=>array(
                    'class'=>'form-control chosen-select',
                    'data-placeholder'=>'Selectionner Personnels'
                )
            ))
        ;
    }

    public function getName()
    {
        return 'action';
    }
} 