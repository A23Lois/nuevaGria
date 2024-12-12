<?php 

namespace App\Controller;

use Exception;
use App\Entity\GeneroMedia;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\GeneroRepository;
use App\Repository\TipoAporteRepository;
use App\Repository\TipoMediaRepository;
use App\Repository\MediaRepository;
use App\Repository\EmpresaRepository;
use App\Repository\EmpresaMediaRepository;
use App\Repository\PersonaRepository;
use App\Repository\PersonaMediaRepository;
use App\Repository\ComentarioRepository;
use App\Repository\GeneroMediaRepository;
use App\Repository\ListaMediaRepository;
use App\Repository\UsuarioRepository;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GestionApiController extends AbstractController
{
    public function __construct()
    {
        
    }
    public function guardarTipoAporte (TipoAporteRepository $repo, $post)
    {
        try{
            $repo->add($post, true);
            $this->addFlash('success', 'Se ha añadido correctamente el tipo de aporte.');
            return $this->redirectToRoute('app_home_index');
        }catch(Exception $exception)
        {
            return $this->redirectToRoute('error', ['exception' => $exception]);
        }
    }

    public function guardarTipoMedia (TipoMediaRepository $repo, $post)
    {
        try{
            $repo->add($post, true);
            $this->addFlash('success', 'Se ha añadido correctamente el tipo de aporte.');
            return $this->redirectToRoute('app_home_index');
        }catch(Exception $exception)
        {
            return $this->redirectToRoute('error', ['exception' => $exception]);
        }
    }

    public function guardarGenero (GeneroRepository $repo, $post)
    {
        try{
            $repo->add($post, true);
            $this->addFlash('success', 'Se ha añadido correctamente el género.');
            return $this->redirectToRoute('app_home_index');
        }catch(Exception $exception)
        {
            return $this->redirectToRoute('error', ['exception' => $exception]);
        }
    }

    public function guardarMedia (MediaRepository $repo, $post)
    {
        try{
            $repo->add($post, true);
            $this->addFlash('success', 'Se ha añadido correctamente la media.');
            return $this->redirectToRoute('app_home_index');
        }catch(Exception $exception)
        {
            return $this->redirectToRoute('error', ['exception' => $exception]);
        }
    }

    #[Route('/gestion/eliminarMedia/{id}', name:'eliminarMediaDB')]
    public function eliminarMedia (MediaRepository $repo, $id)
    {
        try{
            $repo->delete($id, true);
            $this->addFlash('success', 'Se ha eliminado correctamente la media.');
            return $this->redirectToRoute('app_home_index');
        }catch(Exception $exception)
        {
            return $this->redirectToRoute('error', ['exception' => $exception]);
        }
    }

    public function guardarEmpresa (EmpresaRepository $repo, $post)
    {
        try{
            $repo->add($post, true);
            $this->addFlash('success', 'Se ha añadido correctamente la empresa.');
            return $this->redirectToRoute('app_home_index');
        }catch(Exception $exception)
        {
            return $this->redirectToRoute('error', ['exception' => $exception]);
        }
    }

    public function guardarPersona (PersonaRepository $repo, $post)
    {
        try{
            $repo->add($post, true);
            $this->addFlash('success', 'Se ha añadido correctamente la persona.');
            return $this->redirectToRoute('app_home_index');
        }catch(Exception $exception)
        {
            return $this->redirectToRoute('error', ['exception' => $exception]);
        }

    }
    
    #[Route('/gestion/guardarGeneroMedia', name:'addGeneroMedia')]
    public function guardarGeneroMedia (GeneroMediaRepository $repo,Request $request)
    {
        $idMedia =(int) $request->request->get('idMedia');
        $idGenero =(int) $request->request->get('idGenero');

        try{
            $generoMedia = new GeneroMedia ();
            $generoMedia->setIdMedia($idMedia);
            $generoMedia->setIdGenero($idGenero);
            $repo->add($generoMedia, true);

            $this->addFlash('success', 'Se ha añadido correctamente la persona.');
            return new JsonResponse([
                'status' => 'success',
            ]);

        }catch(Exception $exception){
            return $this->redirectToRoute('error', ['exception' => $exception]);
        }
    }

    #[Route('/gestion/eliminarGeneroMedia', name:'eliminarGeneroMedia')]
    public function eliminarGeneroMedia (GeneroMediaRepository $repo,Request $request)
    {
        $idMedia =(int) $request->request->get('idMedia');
        $idGenero =(int) $request->request->get('idGenero');

        try{
            $generoMedia = $repo->getByMediaGenero($idMedia, $idGenero);
            $repo->delete($generoMedia->getId());

            $this->addFlash('success', 'Se ha eliminado correctamente el genero de la media.');
            return new JsonResponse([
                'status' => 'success',
            ]);

        }catch(Exception $exception){
            return $this->redirectToRoute('error', ['exception' => $exception]);
        }
    }

}