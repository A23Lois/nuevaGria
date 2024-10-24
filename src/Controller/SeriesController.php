<?php
namespace App\Controller;

use App\Repository\SeriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

class SeriesController extends AbstractController 
{
    #[Route('series/serie/{idSerie}', name: 'serie')]
    public function mostrarSerie(int $idSerie, SeriesRepository $seriesRepo): Response
    {
        $serie = $seriesRepo->getById($idSerie);
        if(!$serie){
            throw $this->createNotFoundException('Serie no encontrada');
        }

        return $this->render('series/serie.html.twig',['serie' => $serie]);
        
    }
}