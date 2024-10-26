<?php
namespace App\Controller;

use App\Repository\SeriesPruebaRepository;
use App\Service\ImdbSrv;
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

        return $this->render('series/serieprueba.twig',['serie' => $serie]);
        
    }

    #[Route('pruebas/peliculaImdb/{idPelicula}', name: 'PeliculaImdbPrueba')]
    public function mostrarPeliculaImdbPrueba(int $idPelicula,ImdbSrv $ImdbSrv)    
    {
        $movieDetails = $ImdbSrv->getPelicula($idPelicula);

        return $this->render('peliculas/peliculaimdbprueba.twig', [
            'movie' => $movieDetails,
        ]);
    }
}