<?php

namespace App\Integration\Controller;

use App\Util\ControllerUtil;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class IntegrationController extends AbstractController
{
    public function __construct(
        private readonly HttpClientInterface $client,
        private readonly ControllerUtil $serializer
    ) {
    }

    const AUC_JWT = 'eyJhbGciOiJIUzI1NiJ9.eyJhcGlfa2V5IjoiNzFlNWY0YWIxMzI2ZDE0YSIsInNjb3BlcyI6WyJwdXJjaGFzZXMiLCJwbGFuZ3JhcGhzMjAyMCJdLCJpYXQiOjE3MTU2Nzg0MzQsImV4cCI6MTcxNTc2NDgzNCwiaXNzIjoiaHR0cHM6Ly9kZXYuZ29zcGxhbi5pbmZvIiwiYXVkIjoiaHR0cHM6Ly9nb3NwbGFuLmluZm8vYXBpL3YxIiwianRpIjoiY2QyNjAxM2UtMGY2Ny00Y2IxLThkYmEtZjI4YWIwYjVkNDIwIn0.8YeaDOfPYVUMmP-XMzgbF5jrB08nc71yRrJl-4436kc';

    public function getJuridicalData(string $inn): Response {

        $response = $this->client->request(
            'POST',
            'http://suggestions.dadata.ru/suggestions/api/4_1/rs/findById/party',
            [
                'body' => json_encode(['query' => $inn]),
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Token bbcdca16d6aec398e5ef99ccde8b5f153f2654b1'
                ],
            ]
        );

        return new Response($this->serializer->serializeResponse($response->getContent()));
    }

    public function getAuctionData(string $number): Response {
        $response = $this->client->request(
            'GET',
            'https://fz44.gosplan.info/api/v1/purchases/' . $number,
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . self::AUC_JWT
                ]
            ]
        );

        return new Response($this->serializer->serializeResponse($response->getContent()));
    }
}