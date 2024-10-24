<?php
namespace App\Controller;

use App\Model;
use App\Model\Serie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class HomeApiController extends AbstractController
{
    #[Route('api/series')]
    public function index()
    {
        $series = [

            new Serie(1,'Breaking Bad', 'Crime, Drama, Thriller', 'Vince Gilligan', 'completed'),
            new Serie(2,'Stranger Things', 'Drama, Fantasy, Horror', 'The Duffer Brothers', 'ongoing'),
            new Serie(3,'Game of Thrones', 'Action, Adventure, Drama', 'David Benioff, D.B. Weiss', 'completed'),
            new Serie(4,'The Mandalorian', 'Action, Adventure, Sci-Fi', 'Jon Favreau', 'ongoing'),
            new Serie(5,'The Office', 'Comedy', 'Greg Daniels', 'completed')

        ];
        return $this->json($series);
    }
}
