<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class OpenAiClient
{
    private $httpClient;
    private $apiKey;

    public function __construct(HttpClientInterface $httpClient, string $apiKey)
    {
        $this->httpClient = $httpClient;
        $this->apiKey = $apiKey;
    }

    public function generateText(string $prompt, string $model = 'gpt-3.5-turbo'): array
    {
        $url = 'https://api.openai.com/v1/chat/completions';

        $payload = [
            'model' => $model,
            'messages' => [
                [
                    'role' => 'user',  // Rol del mensaje: "user" en este caso
                    'content' => $prompt,
                ]
            ],
            'max_tokens' => 100,
            'temperature' => 0.7,
        ];

        $response = $this->httpClient->request('POST', $url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => $payload,
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Error: ' . $response->getContent(false));
        }

        return $response->toArray();
    }
}