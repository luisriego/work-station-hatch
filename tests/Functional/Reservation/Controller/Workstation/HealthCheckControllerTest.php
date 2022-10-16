<?php

declare(strict_types=1);

namespace App\Tests\Functional\Reservation\Controller\Workstation;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HealthCheckControllerTest extends WorkstationControllerTestBase
{
    private const ENDPOINT = self::CREATE_WORKSTATION_ENDPOINT.'/health-check';

    public function testReservationHealthCheck(): void
    {
        $this->client->request(Request::METHOD_GET, self::ENDPOINT);

        $response = $this->client->getResponse();
        $responseData = json_decode($response->getContent(), true);

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertEquals('Module Workstation up and running!', $responseData['message']);
    }
}