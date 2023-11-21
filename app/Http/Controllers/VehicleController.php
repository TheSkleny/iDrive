<?php

namespace App\Http\Controllers;

use App\Repositories\VehicleRepository;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class VehicleController extends Controller
{
    private VehicleRepository $VehicleRepository;

    public function __construct(VehicleRepository $VehicleRepository)
    {
        $this->VehicleRepository = $VehicleRepository;
    }

    public function getVehicleInfo($vehicleId) : JsonResponse
    {
            return response()->json([
                'data' => $this->VehicleRepository->getVehicleInfo($vehicleId)
            ]);
    }
}
