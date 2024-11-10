<?php 

namespace App\Form;

use App\Repository\MediaRepository;
use App\Repository\TipoMediaRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
        $arrayOtrasMedias = [];
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
        ->add('Titulo')
        ->add('TituloOriginal');
        if(Count($arrayTiposMedia) > 0)
        {
            $builder->add('IdTipoMedia', ChoiceType::class, [ 'choices' => $arrayTiposMedia ]);
        }
        if(Count($arrayOtrasMedias) > 0)
        {
            $builder->add('IdPrecuela', ChoiceType::class, [ 'choices' => $arrayOtrasMedias ]);
            $builder->add('IdSecuela', ChoiceType::class, [ 'choices' => $arrayOtrasMedias ]);
        }
        $builder->add('fechaEstreno', DateType::class, ['widget' => 'choice'])
        ->add('submit', SubmitType::class);
        return $builder;
    }

}