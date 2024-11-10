<?php 

namespace App\Controller;

use App\Repository\GeneroRepository;
use App\Repository\TipoAporteRepository;
use App\Repository\TipoMediaRepository;
use App\Repository\MediaRepository;
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

    public function guardarGenero (GeneroRepository $repo, $post)
    {
        $repo->add($post, true);
        $this->addFlash('success', 'Se ha añadido correctamente el género.');
        return $this->redirectToRoute('listaGeneros');
    }

    public function guardarMedia (MediaRepository $repo, $post)
    {
        $repo->add($post, true);
        $this->addFlash('success', 'Se ha añadido correctamente la media.');
        return $this->redirectToRoute('listaMedias');
    }
}