<?php
namespace App\Controller;

use App\Entity\Media;
use App\Entity\Usuario;
use App\Repository\ComentarioRepository;
use App\Repository\GeneroMediaRepository;
use App\Repository\GeneroRepository;
use App\Repository\ListaMediaRepository;
use App\Repository\MediaRepository;
use App\Repository\TipoMediaRepository;
use App\Repository\UsuarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    public function __construct(private MediaRepository $repoMedia, private TipoMediaRepository $repoTipoMedia, private UsuarioRepository $repoUsuario, private ListaMediaRepository $repoListaMedia, private ComentarioRepository $repoComentario, private GeneroMediaRepository $repoGeneroMedia, private GeneroRepository $repoGenero)
    {
        
    }

    #[Route('/')]
    public function index()
    {
        return $this->render('home/index.twig',[
            'medias' => $this->repoMedia->findUltimas12()
        ]);
    }

    #[Route('/error/{exception}', name:'error')]
    public function error(string $exception)
    {
        return $this->render('home/error.twig',[
            'exception' => $exception
        ]);
    }

    #[Route('/buscar/{titulo}', name:'buscar')]
    public function buscar(string $titulo)
    { 
        $tiposMedias = $this->repoTipoMedia->findAll();
        $diccionarioTiposMedias = [];

        $medias = $this->repoMedia->findByTitulo($titulo);

        foreach($medias as $media)
        {
            $media->setDescripcion(substr($media->getDescripcion(), 0, 600)."..."); 
        }

        foreach ($tiposMedias as $tipoMedia)
        {
            $diccionarioTiposMedias[$tipoMedia->getId()] = $tipoMedia->getTipoMedia();
        }

        return $this->render('home/buscar.twig',[
            'medias' => $medias,
            'tiposMedias' => $diccionarioTiposMedias,
            'textoBusqueda' => 'Busqueda por titulo: "'.$titulo.'"',
        ]);
    }

    #[Route('/buscar/usuario/{usuario}', name:'buscarUsuario')]
    public function buscarUsuario(string $usuario)
    {   
        return $this->render('home/buscarUsuario.twig',[
            'usuarios' => $this->repoUsuario->findByUsuario($usuario),
        ]);
    }

    #[Route('/buscar/TipoMedia/{idTipoMedia}', name:'buscarPorTipoMedia')]
    public function buscarPorTipo(int $idTipoMedia)
    { 
        $tipoMedia = $this->repoTipoMedia->getById($idTipoMedia);
        $diccionarioTiposMedias = [];
        $diccionarioTiposMedias[$tipoMedia->getId()] = $tipoMedia->getTipoMedia();
    
        return $this->render('home/buscar.twig',[
            'medias' => $this->repoMedia->findByIdTipoMedia($idTipoMedia),
            'tiposMedias' => $diccionarioTiposMedias,
            'textoBusqueda' => 'Busqueda por tipo: '.$tipoMedia->getTipoMedia(),
        ]);
    }
    
    #[Route('/buscar/Genero/{idGenero}', name:'buscarPorGenero')]
    public function buscarPorGenero(int $idGenero)
    { 
        $tiposMedias = $this->repoTipoMedia->findAll();
        $diccionarioTiposMedias = [];

        $genero = $this->repoGenero->getById($idGenero);
        $generoMedias = $this->repoGeneroMedia->findByIdGenero($idGenero);
        $medias = [];
        foreach ($generoMedias as $generoMedia)
        {
            $medias [] = $this->repoMedia->getById($generoMedia->getIdMedia());
        }

        foreach ($tiposMedias as $tipoMedia)
        {
            $diccionarioTiposMedias[$tipoMedia->getId()] = $tipoMedia->getTipoMedia();
        }
    
        return $this->render('home/buscar.twig',[
            'medias' => $medias,
            'tiposMedias' => $diccionarioTiposMedias,
            'textoBusqueda' => 'Busqueda por genero: '.$genero->getGenero(),
        ]);
    }

    #[Route('/ver/media/{id}', name:'verMedia')]
    public function verMedia(int $id)
    {   
        $esAnadido = false;
        $esComentado = false;
        $media = $this->repoMedia->getById($id);
        $comentarios = $this->repoComentario->findByMedia($id);
        $generosMedia = $this->repoGeneroMedia->findByIdMedia($id);
        $tipoMedia = $this->repoTipoMedia->getById($media->getIdTipoMedia());
        $comentario = null;
        $usuarioLoggeado = $this->getUser();

        $diccionarioUsuarios = [];
        $generos = [];

        foreach ($comentarios as $comentarioLista)//obtiene todos los comentarios de la media
        {
            $usuarioComentario = $this->repoUsuario->getById($comentarioLista->getIdUsuario());
            $diccionarioUsuarios[$comentarioLista->getId()] = $usuarioComentario;
        }

        foreach ($generosMedia as $generoMedia)//obtiene todos los generos de la media
        {
            $genero = $this->repoGenero->getById($generoMedia->getIdGenero());
            $generos[] = $genero;
        }

        if($usuarioLoggeado != null){
            $correo = $usuarioLoggeado->getUserIdentifier();
            $usuario = $this->repoUsuario->getByCorreo($correo);
            $listaMedia = $this->repoListaMedia->getByUsuarioMedia($usuario->getId(), $id);
            $comentario = $this->repoComentario->getByUsuarioMedia($usuario->getId(), $id);

            if($listaMedia != null)
            {
                $esAnadido = true;
            }
            if($comentario != null)
            {
                $esComentado = true;
            }
        }
        
        return $this->render('home/verMedia.twig', [
            'media' => $media,
            'tipoMedia' => $tipoMedia,
            'esAnadido' => $esAnadido,
            'comentarios' => $comentarios,
            'comentario' => $comentario,
            'esComentado' => $esComentado,
            'usuarios' => $diccionarioUsuarios,
            'generos' => $generos
        ]);
    }

    #[Route('/usuario/perfil', name:'UsuarioPerfil')]
    public function verPerfilUsuario()
    {
        $correo = $this->getUser()->getUserIdentifier();
        $usuario = $this->repoUsuario->getByCorreo($correo);
        $listaMedias = $this->repoListaMedia->findByUsuario($usuario->getId());
        $medias = [];
        $comentarios = [];
        foreach ($listaMedias as $listaMedia)
        {
            $media = $this->repoMedia->getById($listaMedia->getIdMedia());
            $media->setDescripcion(substr($media->getDescripcion(), 0, 600)."...");
            $comentario = $this->repoComentario->getByUsuarioMedia($usuario->getId(), $media->getId());
            $medias[$media->getId()] = $media;
            if($comentario !=  null)
            {
                $comentarios[$media->getId()] = $comentario->getComentario();
            }
        }
        
        return $this->render('usuario/perfil.twig', [
            'medias' => $medias,
            'listaMedias' => $listaMedias,
            'comentarios' => $comentarios,
        ]);
    }

    #[Route('/usuario/perfil/{id}', name:'OtroUsuarioPerfil')]
    public function verPerfilOtroUsuario($id)
    {
        $usuario = $this->repoUsuario->getById($id);
        $listaMedias = $this->repoListaMedia->findByUsuario($usuario->getId());
        $medias = [];
        $comentarios = [];
        foreach ($listaMedias as $listaMedia)
        {
            $media = $this->repoMedia->getById($listaMedia->getIdMedia());
            $media->setDescripcion(substr($media->getDescripcion(), 0, 600)."..."); 
            $comentario = $this->repoComentario->getByUsuarioMedia($usuario->getId(), $media->getId());
            $medias[$media->getId()] = $media;
            if($comentario !=  null)
            {
                $comentarios[$media->getId()] = $comentario->getComentario();
            }
        }
        
        return $this->render('usuario/otroPerfil.twig', [
            'usuario' => $usuario,
            'medias' => $medias,
            'listaMedias' => $listaMedias,
            'comentarios' => $comentarios,
        ]);
    }
    
}
