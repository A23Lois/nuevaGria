<?php
namespace App\Repository;
use App\Model\SeriePrueba;
use Psr\Log\LoggerInterface;

class SeriesPruebaRepository
{
    public function __construct(private LoggerInterface $logger)
    {
        
    }
    public function getAll(): array{
        $series = [

            new SeriePrueba(1,'Breaking Bad', 'Crime, Drama, Thriller', 'Vince Gilligan', 'completed'),
            new SeriePrueba(2,'Stranger Things', 'Drama, Fantasy, Horror', 'The Duffer Brothers', 'ongoing'),
            new SeriePrueba(3,'Game of Thrones', 'Action, Adventure, Drama', 'David Benioff, D.B. Weiss', 'completed'),
            new SeriePrueba(4,'The Mandalorian', 'Action, Adventure, Sci-Fi', 'Jon Favreau', 'ongoing'),
            new SeriePrueba(5,'The Office', 'Comedy', 'Greg Daniels', 'completed')

        ];
        return $series;
    }

    public function getById(int $idSerie): ?SeriePrueba{

        foreach ($this->getAll() as $serie){
            if($serie->getId() == $idSerie){
                return $serie;
            }
        }

        return null;
    }
}