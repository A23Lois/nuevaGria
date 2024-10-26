<?php

namespace App\Controller;

use App\Model;
use App\Model\Serie;
use App\Repository\SeriesPruebaRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MediasApiController  extends AbstractController{

    public function getSeriePrueba(int $idSerie, SeriesPruebaRepository $seriesPruebaRepository)
    {   
        $serie = $seriesPruebaRepository->getById($idSerie);
        return $serie;
    }
}