<?php

namespace App\Http\Controllers;

use App\Models\VehicleType;
use App\Repositories\VehicleTypeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VehicleTypeController extends Controller
{
    private VehicleTypeRepository $VehicleTypeRepository;

    public function __construct(VehicleTypeRepository $VehicleTypeRepository)
    {
        $this->VehicleTypeRepository = $VehicleTypeRepository;
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'data' => $this->VehicleTypeRepository->getVehicleTypeList()
        ]);
    }
}
