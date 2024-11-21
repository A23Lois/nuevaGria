<?php 

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EmpresaFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder        
        ->add('nombre', TextType::class,['attr' => ['class' => 'form-control']])
        ->add('guardar', SubmitType::class,['attr' => ['class' => 'btn btn-primario mt-2']]);
        return $builder;
    }


}