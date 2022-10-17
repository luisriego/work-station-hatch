<?php

declare(strict_types=1);

namespace App\Tests\Functional\Reservation\Controller\Reservation;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HealthCheckControllerTest extends ReservationControllerTestBase
{
    private const ENDPOINT = self::CREATE_RESERVATION_ENDPOINT.'/health-check';

    public function testReservationHealthCheck(): void
    {
        self::$client->request(Request::METHOD_GET, self::ENDPOINT);

        $response = self::$client->getResponse();
        $responseData = json_decode($response->getContent(), true);

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertEquals('Module Reservation up and running!', $responseData['message']);
    }
}