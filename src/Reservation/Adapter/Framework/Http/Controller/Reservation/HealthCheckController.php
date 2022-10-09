<?php

declare(strict_types=1);

namespace App\Reservation\Adapter\Framework\Http\Controller\Reservation;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HealthCheckController extends AbstractController
{
    #[Route('/health-check', name: 'reservation_health_check', methods: ['GET'])]
    public function __invoke(): Response
    {
        return $this->json(['message' => 'Module Reservation up and running!']);
    }
}
