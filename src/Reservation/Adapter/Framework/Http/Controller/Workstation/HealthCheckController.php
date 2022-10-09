<?php

declare(strict_types=1);

namespace App\Reservation\Adapter\Framework\Http\Controller\Workstation;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HealthCheckController extends AbstractController
{
    #[Route('/health-check', name: 'workstation_health_check', methods: ['GET'])]
    public function __invoke(): Response
    {
        return $this->json(['message' => 'Module Workstation up and running!']);
    }
}
