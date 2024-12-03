<?php
namespace App\Controller;

use App\Entity\ListaMedia;
use App\Model;
use App\Model\Serie;
use App\Repository\SeriesRepository;
use Psr\Log\LoggerInterface;
use App\Repository\ListaMediaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class HomeApiController extends AbstractController
{
    #[Route('/usuario/guardarMedia/{idMedia}/{idUsuario}', name:'guardarMedia')]
    public function guardarListaMedia (ListaMediaRepository $repo, $idMedia, $idUsuario)
    {
        $listaMedia = new ListaMedia ();
        $listaMedia->setIdMedia($idMedia);
        $listaMedia->setIdUsuario($idUsuario);
        $repo->add($listaMedia, true);
        $this->addFlash('success', 'Se ha añadido correctamente la persona.');
        return $this->redirectToRoute('verMedia', ['id' => $idMedia]);
    }
}
