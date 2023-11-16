<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Repositories\DriverRepository;


class DriverController extends Controller
{
    private DriverRepository $DriverRepository;

    public function __construct(DriverRepository $DriverRepository)
    {
        $this->DriverRepository = $DriverRepository;
    }

    public function getDriverShifts($driverId) : JsonResponse
    {
            return response()->json([
                'data' => $this->DriverRepository->getDriverShifts($driverId)
            ]);
    }
}

