<?php

namespace App\Http\Controllers;

use App\Repositories\ReportRepository;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ReportController extends Controller
{
    private ReportRepository $ReportRepository;

    public function __construct(ReportRepository $ReportRepository)
    {
        $this->ReportRepository = $ReportRepository;
    }

    public function getReportByTechnicianId($technicianId) : JsonResponse
    {
            return response()->json([
                'data' => $this->ReportRepository->getReportByTechnicianId($technicianId)
            ]);
    }

    public function getReportsByState($stateId) : JsonResponse
    {
            return response()->json([
                'data' => $this->ReportRepository->getReportsByState($stateId)
            ]);
    }
    public function getReportsByStateWithVehicleInfo($stateId) : JsonResponse
    {
            return response()->json([
                'data' => $this->ReportRepository->getReportsByStateWithVehicleInfo($stateId)
            ]);
    }
    public function getReportById($reportId) : JsonResponse
    {
            return response()->json([
                'data' => $this->ReportRepository->getReportById($reportId)
            ]);
    }
    public function createMaintenanceReport(Request $request) : JsonResponse
    {
        return response()->json([
            'data' => $this->ReportRepository->createMaintenanceReport(
                $request->input('submitterId'),
                $request->input('vehicleId'),
                $request->input('technicianId'),
                $request->input('maintenanceDate'),
            )
        ]);
    }
    public function handleReport(Request $request) : JsonResponse
    {
        return response()->json([
            'data' => $this->ReportRepository->handleReport(
                $request->input('reportId'),
                $request->input('technicianId'),
                $request->input('vehicleId'),
                $request->input('maintenanceDate'),
                $request->input('decision')
            )
        ]);
    }
    public function closeReport(Request $request) : JsonResponse
    {
        return response()->json([
            'data' => $this->ReportRepository->closeReport(
                $request->input('reportId'),
                $request->input('technicianId'),
                $request->input('vehicleId'),
                $request->input('technicianDescription'),
                $request->input('decision')
            )
        ]);
    }
}
