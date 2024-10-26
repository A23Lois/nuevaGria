<?php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ImdbSrv
{
    private $cliente;
    private $apiKey;

    public function __construct(HttpClientInterface $cliente)
    {
        $this->cliente = $cliente;
        $this->apiKey = '2ec6026315mshd5a3cb94351a767p1875a3jsnf63cc2b04641'; 
    }

    public function getPelicula($movieId)
    {
        $response = $this->cliente->request('GET', 'https://imdb-api.p.rapidapi.com/title', [
            'query' => [
                'id' => $movieId,
            ],
            'headers' => [
                'X-RapidAPI-Host' => 'imdb-api.p.rapidapi.com',
                'X-RapidAPI-Key' => $this->apiKey,
            ],
        ]);

        return $response->toArray();
    }
}