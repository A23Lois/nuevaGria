<?php

namespace App\Controller;

use App\Model;
use App\Model\Serie;
use App\Repository\SeriesRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SeriesApiController  extends AbstractController{

    public function getSerie(int $idSerie, SeriesRepository $seriesRepository)
    {   
        $serie = $seriesRepository->getById($idSerie);
        return $serie;
    }
}