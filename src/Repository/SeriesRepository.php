<?php
namespace App\Repository;
use App\Model\Serie;
use Psr\Log\LoggerInterface;

class SeriesRepository
{
    public function __construct(private LoggerInterface $logger)
    {
        
    }
    public function getAll(): array{
        $series = [

            new Serie(1,'Breaking Bad', 'Crime, Drama, Thriller', 'Vince Gilligan', 'completed'),
            new Serie(2,'Stranger Things', 'Drama, Fantasy, Horror', 'The Duffer Brothers', 'ongoing'),
            new Serie(3,'Game of Thrones', 'Action, Adventure, Drama', 'David Benioff, D.B. Weiss', 'completed'),
            new Serie(4,'The Mandalorian', 'Action, Adventure, Sci-Fi', 'Jon Favreau', 'ongoing'),
            new Serie(5,'The Office', 'Comedy', 'Greg Daniels', 'completed')

        ];
        return $series;
    }

    public function getById(int $idSerie): ?Serie{

        foreach ($this->getAll() as $serie){
            if($serie->getId() == $idSerie){
                return $serie;
            }
        }

        return null;
    }
}