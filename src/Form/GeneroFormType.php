<?php 

namespace App\Form;

use App\Repository\TipoMediaRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class GeneroFormType extends AbstractType
{
    public function __construct( private TipoMediaRepository $tipoMediaRepo)
    {
        
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {            
        $arrayTiposMedia = [];
        $tiposMedia = $this->tipoMediaRepo->findAll();
        foreach ($tiposMedia as $tipoMedia)
        {
            $id = $tipoMedia->getId();
            $texto = $tipoMedia->getTipoMedia();
            $arrayTiposMedia[$texto] =$id;

        }
        //dd($arrayTiposMedia);

        $builder
        ->add('TipoMedia', ChoiceType::class, [
            'attr' => ['class' => 'form-control'],
            'choices' => $arrayTiposMedia,
        ])        
        ->add('Genero', TextType::class,['attr' => ['class' => 'form-control']])
        ->add('guardar', SubmitType::class,['attr' => ['class' => 'btn btn-primario mt-2']]);
        return $builder;
    }

}