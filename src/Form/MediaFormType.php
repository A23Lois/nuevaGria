<?php 

namespace App\Form;

use App\Repository\MediaRepository;
use App\Repository\TipoMediaRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;

class MediaFormType extends AbstractType
{
    public function __construct( private TipoMediaRepository $tipoMediaRepo, private MediaRepository $mediaRepo)
    {
        
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {            
        $arrayTiposMedia = [];
        $arrayOtrasMedias = ['Ninguna'=> 0];
        $tiposMedia = $this->tipoMediaRepo->findAll();
        $otrasMedias = $this->mediaRepo->findAll();
        foreach ($tiposMedia as $tipoMedia)
        {
            $id = $tipoMedia->getId();
            $texto = $tipoMedia->getTipoMedia();
            $arrayTiposMedia[$texto] = $id;

        }
        
        foreach ($otrasMedias as $otraMedia)
        {
            $id = $otraMedia->getId();
            $texto = $otraMedia->getTitulo();
            $arrayOtrasMedias[$texto] = $id;
        }

        $builder
        ->add('Titulo', TextType::class,['attr' => ['class' => 'form-control']])
        ->add('TituloOriginal', TextType::class,['attr' => ['class' => 'form-control']])
        ->add('Descripcion', TextareaType::class,['attr' => ['class' => 'form-control', 'rows'=>'10']])
        ->add('UrlImagen', TextType::class,['attr' => ['class' => 'form-control']]);
        if(Count($arrayTiposMedia) > 0)
        {
            $builder->add('IdTipoMedia', ChoiceType::class, [ 
                'choices' => $arrayTiposMedia,
                'attr' => ['class' => 'form-control']],);
        }

        if(Count($arrayOtrasMedias) > 0)
        {
            $builder->add('IdPrecuela', ChoiceType::class, [
                 'choices' => $arrayOtrasMedias,
                'attr' => ['class' => 'form-control']]);
            $builder->add('IdSecuela', ChoiceType::class, [ 
                'choices' => $arrayOtrasMedias,
                'attr' => ['class' => 'form-control']]);
        }
        $builder->add('fechaEstreno', DateType::class, [
            'widget' => 'choice',
            'years' => range(1950, date('Y')),
            'format' => 'ddMMyyyy',])
        ->add('guardar', SubmitType::class,['attr' => ['class' => 'btn btn-primario mt-2']]);
        return $builder;
    }

}