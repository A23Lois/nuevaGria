<?php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class OpenLibrarySrv
{
    private HttpClientInterface $client;

    // Inyectamos el cliente HTTP
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    // Método para obtener todos los libros en español desde Open Library
    public function getAllBooksFromOpenLibrary(): array
    {
        $allBooks = [];
        $page = 1;
        $limit = 100; // Podemos cambiar este valor para obtener más libros por página

        while (true) {
            $response = $this->client->request('GET', 'https://openlibrary.org/search.json', [
                'query' => [
                    'language' => 'spa',
                    'page' => $page,
                    'limit' => $limit
                ]
            ]);

            // Obtener los datos de la respuesta
            $data = $response->toArray();

            // Si no hay más resultados, detenemos la paginación
            if (empty($data['docs'])) {
                break;
            }

            // Agregar los libros de esta página
            $allBooks = array_merge($allBooks, $data['docs']);
            
            // Si no hay más páginas, detenemos el bucle
            if (!isset($data['next']) || !$data['next']) {
                break;
            }

            $page++;
        }

        return $allBooks;
    }

    // Método para obtener todos los libros en español desde Gutendex
    public function getAllBooksFromGutendex(): array
    {
        $allBooks = [];
        $page = 1;
        $pageSize = 100; // El tamaño de la página

        while (true) {
            $response = $this->client->request('GET', 'https://gutendex.com/books/', [
                'query' => [
                    'languages' => 'es',  // Filtrar por libros en español
                    'page' => $page,
                    'page_size' => $pageSize
                ]
            ]);

            // Obtener los datos de la respuesta
            $data = $response->toArray();

            // Si no hay más resultados, detenemos la paginación
            if (empty($data['results'])) {
                break;
            }

            // Agregar los libros de esta página
            $allBooks = array_merge($allBooks, $data['results']);

            // Si no hay más páginas, detenemos el bucle
            if (empty($data['next'])) {
                break;
            }

            $page++;
        }

        return $allBooks;
    }
}