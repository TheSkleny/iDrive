<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Repositories\LinesRepository;

class LinesController extends Controller
{
    private LinesRepository $LinesRepository;

    public function __construct(LinesRepository $LinesRepository)
    {
        $this->LinesRepository = $LinesRepository;
    }

    public function getLines() : JsonResponse
    {
            return response()->json([
                'data' => $this->LinesRepository->getLines()
            ]);
    }
    
    public function getLine($lineId) : JsonResponse
    {
            return response()->json([
                'data' => $this->LinesRepository->getLine($lineId)
            ]);
    }

    public function createLine(Request $request) : JsonResponse
    {
        return response()->json([
            'data' => $this->LinesRepository->createLine(
                $request->input('lineName'),
                $request->input('lineTypeId')
            )
        ]);
    }

    public function createLineStops(Request $request) : JsonResponse
    {
        return response()->json([
            'data' => $this->LinesRepository->createLineStops(
                $request->input('lineName'),
                $request->input('stopName1'),
                $request->input('stopName2'),
                $request->input('timeBetweenStops'),
                $request->input('order')
            )
        ]);
    }

    public function updateLine(Request $request) : JsonResponse
    {
        return response()->json([
            'data' => $this->LinesRepository->updateLine(
                $request->input('lineId'),
                $request->input('lineName'),
                $request->input('lineTypeId')
            )
        ]);
    }

    public function updateLineStops(Request $request) : JsonResponse
    {
        return response()->json([
            'data' => $this->LinesRepository->updateLineStops(
                $request->input('lineId'),
                $request->input('stopName1'),
                $request->input('stopName2'),
                $request->input('timeBetweenStops'),
                $request->input('order')
            )
        ]);
    }

    public function deleteLine($lineId) : JsonResponse
    {
        return response()->json([
            'data' => $this->LinesRepository->deleteLine($lineId)
        ]);
    }
}
