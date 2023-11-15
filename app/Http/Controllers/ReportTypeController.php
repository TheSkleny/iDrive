<?php

namespace App\Http\Controllers;

use App\Interfaces\ReportTypeRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReportTypeController extends Controller
{
    private ReportTypeRepositoryInterface $ReportTypeRepository;

    public function __construct(ReportTypeRepositoryInterface $ReportTypeRepository)
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
