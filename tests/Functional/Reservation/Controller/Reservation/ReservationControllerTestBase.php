<?php

declare(strict_types=1);

namespace App\Tests\Functional\Reservation\Controller\Reservation;

use App\Tests\Functional\Reservation\Controller\ControllerTestBase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\AbstractBrowser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ReservationControllerTestBase extends ControllerTestBase
{
    protected const CREATE_RESERVATION_ENDPOINT = '/api/reservations';
    protected const NON_EXISTING_RESERVATION_ID = 'e0a1878f-dd52-4eea-959d-96f589a9f234';

    protected function createReservation(): string
    {
        $today = new \DateTime();
        $payload = [
            'startDate' => date_add($today, date_interval_create_from_date_string("1 days")),
            'endDate' => date_add($today, date_interval_create_from_date_string("5 days")),
            'workstation' => self::NON_EXISTING_RESERVATION_ID,
        ];

        self::$client->request(Request::METHOD_POST, self::CREATE_RESERVATION_ENDPOINT, [], [], [], \json_encode($payload));

        $response = self::$client->getResponse();

        if (Response::HTTP_CREATED !== $response->getStatusCode()) {
            throw new \RuntimeException('Error creating reservation');
        }

        $responseData = $this->getResponseData($response);

        return $responseData['reservationId'];
    }
}