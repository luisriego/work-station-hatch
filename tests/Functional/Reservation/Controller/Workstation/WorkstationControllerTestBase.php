<?php

declare(strict_types=1);

namespace App\Tests\Functional\Reservation\Controller\Workstation;

use App\Tests\Functional\Reservation\Controller\ControllerTestBase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\AbstractBrowser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class WorkstationControllerTestBase extends ControllerTestBase
{
    protected const CREATE_WORKSTATION_ENDPOINT = '/api/workstations';
    protected const NON_EXISTING_WORKSTATION_ID = 'e0a1878f-dd52-4eea-959d-96f589a9f234';

    protected function createWorkstation(): string
    {
        $payload = [
            'name' => 'WS001',
            'floor' => '19th',
            'office' => 'Belo Horizonte',
            'isActive' => true,
        ];

        self::$client->request(Request::METHOD_POST, self::CREATE_WORKSTATION_ENDPOINT, [], [], [], \json_encode($payload));

        $response = self::$client->getResponse();

        if (Response::HTTP_CREATED !== $response->getStatusCode()) {
            throw new \RuntimeException('Error creating workstation');
        }

        $responseData = $this->getResponseData($response);

        return $responseData['workstationId'];
    }
}