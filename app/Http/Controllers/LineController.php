<?php

namespace App\Http\Controllers;

use App\Repositories\LineRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LineController extends Controller
{
    private LineRepository $LineRepository;

    public function __construct(LineRepository $LineRepository)
        {
            $this->LineRepository = $LineRepository;
        }

        public function index(): JsonResponse
        {
            return response()->json([
                'data' => $this->LineRepository->getLineList()
            ]);
        }
}