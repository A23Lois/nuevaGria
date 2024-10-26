<?php
namespace App\Controller;

use App\Repository\SeriesPruebaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

class MediasController extends AbstractController 
{
    #[Route('pruebas/serie/{idSerie}', name: 'SeriePrueba')]
    public function mostrarSeriePrueba(int $idSerie, SeriesPruebaRepository $seriesPruebaRepo): Response
    {
        $serie = $seriesPruebaRepo->getById($idSerie);
        if(!$serie){
            throw $this->createNotFoundException('Serie no encontrada');
        }

        return $this->render('series/serie.html.twig',['serie' => $serie]);
        
    }

    #[Route]
    public function mostrarPelicula()    
    {

        return $this->render('series/serie.html.twig',['serie' => '$serie']);
        
    }
}