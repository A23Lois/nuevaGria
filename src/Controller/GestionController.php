<?php 

namespace App\Controller;

use App\Entity\TipoAporte;
use App\Entity\TipoMedia;
use App\Repository\TipoAporteRepository;
use App\Repository\TipoMediaRepository;
use App\Repository\UsuarioRepository;
use App\Form\TipoMediaFormType;
use App\Form\TipoAporteFormType;
use App\Controller\GestionApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

class GestionController extends AbstractController
{

public function __construct(private GestionApiController $gestionApiController)
{
    
}
//----------LISTAS
    #[Route('gestion/listaTiposMedias', name: 'listaTiposMedias')]
    public function mostrarTiposMedias(TipoMediaRepository $repo) : Response
    {

        return $this->render('gestion/listaTiposMedias.twig',[
            'tiposMedias' => $repo->findAll()
        ]);

    }

        #[Route('gestion/listaTiposAportes', name:'listaTiposAportes')]
    public function mostrarTiposAportes(TipoAporteRepository $repo) : Response
    {

        return $this->render('gestion/listaTiposAportes.twig',[
            'tiposAportes' => $repo->findAll()
        ]);

    }

    #[Route('gestion/listaUsuarios', name:'listaUsuarios')]
    public function mostrarUsuarios(UsuarioRepository $repo) : Response
    {

        return $this->render('gestion/listaUsuarios.twig',[
            'usuarios' => $repo->findAll()
        ]);

    }
//----------NUEVOS
    #[Route('/gestion/nuevoTipoAporte', name:'nuevoTipoAporte')]
    public function nuevoTipoAporte(TipoAporteRepository $repo, Request $request){
        $tipoAporte = new TipoAporte();
        $form = $this->createForm(TipoAporteFormType::class, $tipoAporte);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $post = $form->getData();
            return $this->gestionApiController->guardarTipoAporte($repo, $post);
        }
        return $this->render('gestion/nuevoTipoAporte.twig',['form' => $form]);
    }

    #[Route('/gestion/nuevoTipoMedia', name:'nuevoTipoMedia')]
    public function nuevoTipoMedia(TipoMediaRepository $repo, Request $request){
        $tipoMedia = new TipoMedia();
        $form = $this->createForm(TipoMediaFormType::class, $tipoMedia);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $post = $form->getData();
            return $this->gestionApiController->guardarTipoMedia($repo, $post);
        }
        return $this->render('gestion/nuevoTipoMedia.twig',['form' => $form]);
    }
}