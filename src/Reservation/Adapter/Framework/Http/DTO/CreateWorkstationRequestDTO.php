<?php

declare(strict_types=1);

namespace App\Reservation\Adapter\Framework\Http\DTO;

use Symfony\Component\HttpFoundation\Request;

class CreateWorkstationRequestDTO implements RequestDTO
{
    public readonly string $id;
    public ?string $name;
    public ?string $floor;
    public ?string $office;
    public ?bool $isActive;

    public function __construct(Request $request)
    {
        $this->name = $request->request->get('name');
        $this->floor = $request->request->get('floor');
        $this->office = $request->request->get('office');
        $this->isActive = $request->request->get('isActive');
    }
}
