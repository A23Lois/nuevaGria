<?php
namespace App\Controller;

use App\Entity\ListaMedia;
use App\Repository\ListaMediaRepository;
use App\Repository\UsuarioRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class HomeApiController extends AbstractController
{
    public function __construct(private ListaMediaRepository $repoListaMedia, private UsuarioRepository $repoUsuario)
    {
        
    }

    #[Route('/usuario/guardarMedia/{idMedia}/{idUsuario}', name:'guardarMedia')]
    public function guardarListaMedia ($idMedia, $idUsuario)
    {
        try{
            $correo = $this->getUser()->getUserIdentifier();
            $usuario = $this->repoUsuario->getByCorreo($correo);
            if($usuario->getId() == $idUsuario)
            {
                $listaMedia = new ListaMedia ();
                $listaMedia->setIdMedia($idMedia);
                $listaMedia->setIdUsuario($idUsuario);
                $this->repoListaMedia->add($listaMedia, true);
                $this->addFlash('success', 'Se ha añadido correctamente la persona.');
                return $this->redirectToRoute('verMedia', ['id' => $idMedia]);
            }
            else
            {
                throw new Exception("Error id de usuario inválido");
            }
        }catch(Exception $exception){
            return $this->redirectToRoute('error', ['exception' => $exception]);
        }
    }
    
    #[Route('/usuario/eliminarMedia/{idMedia}/{idUsuario}', name:'eliminarMedia')]
    public function eliminarListaMedia ($idMedia, $idUsuario)
    {
        try{
            $correo = $this->getUser()->getUserIdentifier();
            $usuario = $this->repoUsuario->getByCorreo($correo);
            if($usuario->getId() == $idUsuario)
            {
                $listaMedia = $this->repoListaMedia->getByUsuarioMedia($idUsuario, $idMedia);
                $this->repoListaMedia->delete($listaMedia->getId());
                $this->addFlash('success', 'Se ha eliminado correctamente la persona.');
                return $this->redirectToRoute('verMedia', ['id' => $idMedia]);
            }
            else
            {
                throw new Exception("Error id de usuario inválido");
            }
        }catch(Exception $exception){
            return $this->redirectToRoute('error', ['exception' => $exception]);
        }
    }
}
