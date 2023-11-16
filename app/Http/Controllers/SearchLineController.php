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

        public function index(): JsonResponse
        {
            return response()->json([
                'data' => $this->LineRepository->getLineList()
            ]);
        }
}
