<?php
namespace App\Controller;

use App\Entity\Media;
use App\Repository\MediaRepository;
use App\Repository\TipoMediaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    public function __construct(private MediaRepository $repoMedia, private TipoMediaRepository $repoTipoMedia)
    {
        
    }

    #[Route('/')]
    public function index()
    {
        return $this->render('home/index.twig',[
            'medias' => $this->repoMedia->findUltimas10()
        ]);
    }

    #[Route('/buscar/{titulo}', name:'buscar')]
    public function buscar(string $titulo)
    { 
        $tiposMedias = $this->repoTipoMedia->findAll();
        $diccionarioTiposMedias = [];

        foreach ($tiposMedias as $tipoMedia)
        {
            $diccionarioTiposMedias[$tipoMedia->getId()] = $tipoMedia->getTipoMedia();
        }

        return $this->render('home/buscar.twig',[
            'medias' => $this->repoMedia->findByTitulo($titulo),
            'tiposMedias' => $diccionarioTiposMedias,
        ]);
    }

    #[Route('/ver/media/{id}', name:'verMedia')]
    public function verMedia(int $id)
    {
         $media = $this->repoMedia->getById($id);
        $tipoMedia = $this->repoTipoMedia->getById($media->getIdTipoMedia());
        
        return $this->render('home/verMedia.twig', [
            'media' => $media,
            'tipoMedia' => $tipoMedia
        ]);
    }
    
}
