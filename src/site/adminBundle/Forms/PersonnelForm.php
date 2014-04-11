<?php
/**
 * Created by PhpStorm.
 * User: kh3dr0n
 * Date: 11/04/2014
 * Time: 22:07
 */

namespace site\adminBundle\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;

class PersonnelForm extends AbstractType{
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
            ->add('poste','choice',array('choices' => array('Commandant du bord'=>'Commandant du bord','Copilote'=>'Copilote','Stewart'=>'Stewart','Hôtesse'=>'Hôtesse'),'attr'=>array('class'=>'form-control input-sm mb15')))
        ;
    }

    public function getName()
    {
        return 'action';
    }
} 