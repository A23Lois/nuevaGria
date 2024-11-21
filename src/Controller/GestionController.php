<?php 

namespace App\Controller;

use App\Entity\TipoAporte;
use App\Entity\TipoMedia;
use App\Entity\Media;
use App\Entity\Genero;
use App\Entity\Empresa;
use App\Repository\TipoAporteRepository;
use App\Repository\TipoMediaRepository;
use App\Repository\GeneroRepository;
use App\Repository\MediaRepository;
use App\Repository\EmpresaRepository;
use App\Repository\UsuarioRepository;
use App\Form\TipoMediaFormType;
use App\Form\TipoAporteFormType;
use App\Form\GeneroFormType;
use App\Form\MediaFormType;
use App\Form\EmpresaFormType;
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

    #[Route('gestion/listaGeneros', name:'listaGeneros')]
    public function mostrarGeneros(GeneroRepository $repo) : Response
    {

        return $this->render('gestion/listaGeneros.twig',[
            'generos' => $repo->findAll()
        ]);

    }

    #[Route('gestion/listaMedias', name:'listaMedias')]
    public function mostrarMedias(MediaRepository $repo) : Response
    {

        return $this->render('gestion/listaMedias.twig',[
            'medias' => $repo->findAll()
        ]);

    }

    #[Route('gestion/listaEmpresas', name:'listaEmpresas')]
    public function mostrarEmpresas(EmpresaRepository $repo) : Response
    {

        return $this->render('gestion/listaEmpresas.twig',[
            'empresas' => $repo->findAll()
        ]);

    }


//----------GESTION DE TABLAS

    //--------------TIPO APORTE
        //--------------NUEVO
    #[Route('/gestion/nuevoTipoAporte', name:'nuevoTipoAporte')]
    public function nuevoTipoAporte(TipoAporteRepository $repo, Request $request){
        $tipoAporte = new TipoAporte();
        $form = $this->createForm(TipoAporteFormType::class, $tipoAporte);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $post = $form->getData();
            return $this->gestionApiController->guardarTipoAporte($repo, $post);
        }
        return $this->render('gestion/editarTipoAporte.twig',['form' => $form]);
    }
        //--------------EDITAR
    #[Route('/gestion/editarTipoAporte/{id}', name:'editarTipoAporte')]
    public function editarTipoAporte(TipoAporteRepository $repo, Request $request, int $id){
        $tipoAporte = $repo->getById($id);
        $form = $this->createForm(TipoAporteFormType::class, $tipoAporte);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $post = $form->getData();
            return $this->gestionApiController->guardarTipoAporte($repo, $post);
        }
        return $this->render('gestion/editarTipoAporte.twig',['form' => $form]);
    }

    //--------------TIPO MEDIA
        //--------------NUEVO
    #[Route('/gestion/nuevoTipoMedia', name:'nuevoTipoMedia')]
    public function nuevoTipoMedia(TipoMediaRepository $repo, Request $request){
        $tipoMedia = new TipoMedia();
        $form = $this->createForm(TipoMediaFormType::class, $tipoMedia);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $post = $form->getData();
            return $this->gestionApiController->guardarTipoMedia($repo, $post);
        }
        return $this->render('gestion/editarTipoMedia.twig',['form' => $form]);
    }
        //--------------EDITAR
    #[Route('/gestion/editarTipoMedia/{id}', name:'editarTipoMedia')]
    public function editarTipoMedia(TipoMediaRepository $repo, Request $request, int $id){
        $tipoMedia = $repo->getById($id);
        $form = $this->createForm(TipoMediaFormType::class, $tipoMedia);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $post = $form->getData();
            return $this->gestionApiController->guardarTipoMedia($repo, $post);
        }
        return $this->render('gestion/editarTipoMedia.twig',['form' => $form]);
    }
    //-------------GENERO
            //--------------NUEVO
        #[Route('/gestion/nuevoGenero', name:'nuevoGenero')]
        public function nuevoGenero(GeneroRepository $repo, Request $request){
            $genero = new Genero();
            $form = $this->createForm(GeneroFormType::class, $genero);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $post = $form->getData();
                return $this->gestionApiController->guardarGenero($repo, $post);
            }
            return $this->render('gestion/editarGenero.twig',['form' => $form]);
        }
            //--------------EDITAR
        #[Route('/gestion/editarGenero/{id}', name:'editarGenero')]
        public function editarGenero(GeneroRepository $repo, Request $request, int $id)
        {
            $genero = $repo->getById($id);
            $form = $this->createForm(GeneroFormType::class, $genero);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $post = $form->getData();
                return $this->gestionApiController->guardarGenero($repo, $post);
            }
            return $this->render('gestion/editarGenero.twig',['form' => $form]);
        }

        //-------------MEDIA
            //--------------NUEVO
        #[Route('/gestion/nuevaMedia', name:'nuevaMedia')]
        public function nuevaMedia(MediaRepository $repo, Request $request){
            $genero = new Media();
            $form = $this->createForm(MediaFormType::class, $genero);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $post = $form->getData();
                return $this->gestionApiController->guardarMedia($repo, $post);
            }
            return $this->render('gestion/editarMedia.twig',['form' => $form]);
        }
            //--------------EDITAR
        #[Route('/gestion/editarMedia/{id}', name:'editarMedia')]
        public function editarMedia(MediaRepository $repo, Request $request, int $id)
        {
            $genero = $repo->getById($id);
            $form = $this->createForm(MediaFormType::class, $genero);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $post = $form->getData();
                return $this->gestionApiController->guardarMedia($repo, $post);
            }
            return $this->render('gestion/editarMedia.twig',['form' => $form]);
        }
    //--------------EMPRESA
        //--------------NUEVO
    #[Route('/gestion/nuevaEmpresa', name:'nuevaEmpresa')]
    public function nuevaEmpresa(EmpresaRepository $repo, Request $request){
        $empresa = new Empresa();
        $form = $this->createForm(EmpresaFormType::class, $empresa);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $post = $form->getData();
            return $this->gestionApiController->guardarEmpresa($repo, $post);
        }
        return $this->render('gestion/editarEmpresa.twig',['form' => $form]);
    }
        //--------------EDITAR
    #[Route('/gestion/editarEmpresa/{id}', name:'editarEmpresa')]
    public function editarEmpresa(EmpresaRepository $repo, Request $request, int $id){
        $empresa = $repo->getById($id);
        $form = $this->createForm(EmpresaFormType::class, $empresa);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $post = $form->getData();
            return $this->gestionApiController->guardarEmpresa($repo, $post);
        }
        return $this->render('gestion/editarEmpresa.twig',['form' => $form]);
    }
}