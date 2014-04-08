<?php
/**
 * Created by PhpStorm.
 * User: kh3dr0n
 * Date: 07/04/2014
 * Time: 19:30
 */

namespace site\adminBundle\Forms;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;

class AvionForm extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('capacite','text',array('attr'=>array('class'=>'form-control')))
            ->add('model','text',array('attr'=>array('class'=>'form-control')))
        ;
    }

    public function getName()
    {
        return 'action';
    }
} 