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

    public function getVehiclesByState($stateId) : JsonResponse
    {
            return response()->json([
                'data' => $this->VehicleRepository->getVehiclesByState($stateId)
            ]);
    }
    public function getVehicleInfo($vehicleId) : JsonResponse
    {
            return response()->json([
                'data' => $this->VehicleRepository->getVehicleInfo($vehicleId)
            ]);
    }
    public function reportVehicleMalfunction(Request $request) : JsonResponse
    {
        return response()->json([
            'data' => $this->VehicleRepository->reportVehicleMalfunction(
                $request->input('submitterId'),
                $request->input('description'),
                $request->input('vehicleId')
            )
        ]);
    }
    public function updateVehicleInfo(Request $request) : JsonResponse
    {
        return response()->json([
            'data' => $this->VehicleRepository->updateVehicleInfo(
                $request->input('vehicleId'),
                $request->input('name'),
                $request->input('brand'),
                $request->input('imageUri'),
                $request->input('capacity'),
                $request->input('speedLimit'),
                $request->input('licensePlate'),
                $request->input('typeId')
            )
        ]);
    }
    public function addVehicle(Request $request) : JsonResponse
    {
        return response()->json([
            'data' => $this->VehicleRepository->addVehicle(
                $request->input('name'),
                $request->input('brand'),
                $request->input('imageUri'),
                $request->input('capacity'),
                $request->input('speedLimit'),
                $request->input('licensePlate'),
                $request->input('typeId')
            )
        ]);
    }
    public function deleteVehicle($vehicleId) : JsonResponse
    {
        return response()->json([
            'data' => $this->VehicleRepository->deleteVehicle($vehicleId)
        ]);
    }
}
