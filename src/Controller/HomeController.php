<?php
namespace App\Controller;

use App\Entity\Media;
use App\Entity\Usuario;
use App\Repository\ListaMediaRepository;
use App\Repository\MediaRepository;
use App\Repository\TipoMediaRepository;
use App\Repository\UsuarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    public function __construct(private MediaRepository $repoMedia, private TipoMediaRepository $repoTipoMedia, private UsuarioRepository $repoUsuario, private ListaMediaRepository $repoListaMedia)
    {
        
    }

    #[Route('/')]
    public function index()
    {
        return $this->render('home/index.twig',[
            'medias' => $this->repoMedia->findUltimas10()
        ]);
    }

    #[Route('/buscar/{titulo}', name:'buscar')]
    public function buscar(string $titulo)
    { 
        $tiposMedias = $this->repoTipoMedia->findAll();
        $diccionarioTiposMedias = [];

        foreach ($tiposMedias as $tipoMedia)
        {
            $diccionarioTiposMedias[$tipoMedia->getId()] = $tipoMedia->getTipoMedia();
        }

        return $this->render('home/buscar.twig',[
            'medias' => $this->repoMedia->findByTitulo($titulo),
            'tiposMedias' => $diccionarioTiposMedias,
        ]);
    }

    #[Route('/ver/media/{id}', name:'verMedia')]
    public function verMedia(int $id)
    {   
        $esAnadido = false;
        $media = $this->repoMedia->getById($id);
        $tipoMedia = $this->repoTipoMedia->getById($media->getIdTipoMedia());
        $usuarioLoggeado = $this->getUser();
        if($usuarioLoggeado != null){
            $correo = $usuarioLoggeado->getUserIdentifier();
            $usuario = $this->repoUsuario->getByCorreo($correo);
            $listaMedia = $this->repoListaMedia->getByUsuarioMedia($usuario->getId(), $id);
            if($listaMedia != null)
            {
                $esAnadido = true;
            }
        }
        
        return $this->render('home/verMedia.twig', [
            'media' => $media,
            'tipoMedia' => $tipoMedia,
            'esAnadido' => $esAnadido
        ]);
    }

    #[Route('/usuario/perfil', name:'UsuarioPerfil')]
    public function verPerfilUsuario()
    {
        $correo = $this->getUser()->getUserIdentifier();
        $usuario = $this->repoUsuario->getByCorreo($correo);
        $listaMedias = $this->repoListaMedia->findByUsuario($usuario->getId());
        $medias = [];
        foreach ($listaMedias as $listaMedia)
        {
            $media = $this->repoMedia->getById($listaMedia->getIdMedia());
            $medias[$media->getId()] = $media;
        }
        
        return $this->render('usuario/perfil.twig', [
            'medias' => $medias,
            'listaMedias' => $listaMedias,
        ]);
    }
    
}
