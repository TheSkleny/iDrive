<?php

namespace App\Http\Controllers;

use App\Repositories\ReportTypeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReportTypeController extends Controller
{
    private ReportTypeRepository $ReportTypeRepository;

    public function __construct(ReportTypeRepository $ReportTypeRepository)
        {
            $this->ReportTypeRepository = $ReportTypeRepository;
        }

        public function index(): JsonResponse
        {
            return response()->json([
                'data' => $this->ReportTypeRepository->getAll()
            ]);
        }
}
