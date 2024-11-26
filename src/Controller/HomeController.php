<?php
namespace App\Controller;

use App\Entity\Media;
use App\Repository\MediaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/')]
    public function index(MediaRepository $repo)
    {
        return $this->render('home/index.twig',[
            'medias' => $repo->findUltimas10()
        ]);
    }

    #[Route('/buscar/{nombre}', name:'buscar')]
    public function buscar(string $nombre)
    { 
        dd($nombre);
        return $this->render('home/index.twig',[
            'medias' => $repo->findUltimas10()
        ]);
    }

    
}
