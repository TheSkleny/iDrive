<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Repositories\LineDetailRepository;

class LineDetailController extends Controller
{
    private LineDetailRepository $LineDetailRepository;

    public function __construct(LineDetailRepository $LineDetailRepository)
    {
        $this->LineDetailRepository = $LineDetailRepository;
    }

    public function getLineStops($lineId) : JsonResponse
    {
            return response()->json([
                'data' => $this->LineDetailRepository->getLineStops($lineId)
            ]);
    }
}
