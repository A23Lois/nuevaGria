<?php 

namespace App\Controller;
use App\Repository\TipoAporteRepository;
use App\Repository\TipoMediaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GestionApiController extends AbstractController
{
    public function __construct()
    {
        
    }
    public function guardarTipoAporte (TipoAporteRepository $repo, $post)
    {
            $repo->add($post, true);
            $this->addFlash('success', 'Se ha añadido correctamente el tipo de aporte.');
            return $this->redirectToRoute('listaTiposAportes');

    }

    public function guardarTipoMedia (TipoMediaRepository $repo, $post)
    {
            $repo->add($post, true);
            $this->addFlash('success', 'Se ha añadido correctamente el tipo de aporte.');
            return $this->redirectToRoute('listaTiposMedias');

    }
}