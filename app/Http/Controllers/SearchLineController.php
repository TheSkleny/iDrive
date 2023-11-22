<?php

namespace App\Http\Controllers;

use App\Repositories\SearchLineRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SearchLineController extends Controller
{
    private SearchLineRepository $LineRepository;

    public function __construct(SearchLineRepository $LineRepository)
        {
            $this->LineRepository = $LineRepository;
        }

        public function getLineList(): JsonResponse
        {
            return response()->json([
                'data' => $this->LineRepository->getLineList()
            ]);
        }

        public function getLineTypes(): JsonResponse
        {
            return response()->json([
                'data' => $this->LineRepository->getLineTypes()
            ]);
        }
}
