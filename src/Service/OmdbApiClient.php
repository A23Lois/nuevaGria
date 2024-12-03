<?php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class OmdbApiClient
{
    private HttpClientInterface $httpClient;
    private string $apiKey;

    public function __construct(HttpClientInterface $httpClient, string $apiKey)
    {
        $this->httpClient = $httpClient;
        $this->apiKey = $apiKey;
    }

    public function fetchMovie(string $title): array
    {
        $response = $this->httpClient->request('GET', 'http://www.omdbapi.com/', [
            'query' => [
                'apikey' => $this->apiKey,
                't' => $title, // Nombre de la película
                'lang' => "es"
            ],
        ]);

        return $response->toArray(); // Convierte la respuesta JSON en un array PHP
    }
}
