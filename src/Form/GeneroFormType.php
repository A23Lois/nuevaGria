<?php 

namespace App\Form;

use App\Repository\TipoMediaRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

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

            'choices' => $arrayTiposMedia,

        ])        
        ->add('Genero')
        ->add('submit', SubmitType::class);
        return $builder;
    }

}