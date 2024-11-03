<?php 

namespace App\Controller;

use App\Repository\TipoAporteRepository;
use App\Repository\TipoMediaRepository;
use App\Repository\UsuarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

class GestionController extends AbstractController
{

public function __construct()
{
    
}
//----------LISTAS
    #[Route('gestion/listaTiposMedias')]
    public function mostrarTiposMedias(TipoMediaRepository $repo) : Response
    {

        return $this->render('gestion/tiposMedias.twig',[
            'tiposMedias' => $repo->getAll()
        ]);

    }

        #[Route('gestion/listaTiposAportes')]
    public function mostrarTiposAportes(TipoAporteRepository $repo) : Response
    {

        return $this->render('gestion/tiposAportes.twig',[
            'tiposAportes' => $repo->getAll()
        ]);

    }

    #[Route('gestion/listaUsuarios')]
    public function mostrarUsuarios(UsuarioRepository $repo) : Response
    {

        return $this->render('gestion/usuarios.twig',[
            'usuarios' => $repo->getAll()
        ]);

    }
//----------
    /*#[Route('/gnerar/Media', name:'media')]
    public function gnerarTMedias(Request $request, EntityManagerInterface $manejadorEntidad){
        
    }*/
}