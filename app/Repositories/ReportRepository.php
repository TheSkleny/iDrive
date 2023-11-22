<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

use App\Models\Report;

class ReportRepository
{
    public function getReportsByState($stateIds) : array
    {
        if ($stateIds == 'all') {
            return DB::select('
                select * from "Report"
            ');
        }
        else {
            $stateIdsArray = array_map('trim',explode(';', $stateIds));
            return DB::select('
                select * from "Report"
                where "StateId" in (' . implode(',', $stateIdsArray) . ')
            ');
        }
    }
    public function createMaintenanceReport($submitterId, $vehicleId, $technicianId) {
        DB::insert('
            insert into "Report"
                (
                    "ReportDate",
                    "SubmitterId", 
                    "Description", 
                    "VehicleId", 
                    "TechnicianId", 
                    "TechnicianDescription", 
                    "MaintenanceDate", 
                    "StateId", 
                    "TypeId"
                )
            values
                (
                    cast(NOW() as date), 
                    :submitterId, 
                    \'Maintenance report\', 
                    :vehicleId, 
                    :technicianId,
                    NULL, 
                    NULL, 
                    3,
                    2
                )
        ', ['submitterId' => $submitterId, 'vehicleId' => $vehicleId, 'technicianId' => $technicianId]
        );
    }
    public function handleReport($reportId, $technicianId, $decision) {
        if ($decision == 'accept') {
            DB::update('
                update "Report"
                set 
                    "StateId" = 3,
                    "TechnicianId" = :technicianId
                where "Id" = :reportId
            ', ['technicianId' => $technicianId, 'reportId' => $reportId]
            );
        }
        else if ($decision == 'reject') {
            DB::update('
                update "Report"
                set "StateId" = 2,
                where "Id" = :reportId
            ', ['reportId' => $reportId]
            );
        }
    }
    public function closeReport($reportId, $technicianId, $technicianDescription) {
        DB::update(
            'update "Report"
            set 
                "StateId" = 4,
                "TechnicianId" = :technicianId,
                "TechnicianDescription" = :technicianDescription,
                "MaintenanceDate" = cast(NOW() as date)
            where "Id" = :reportId
        ', ['technicianId' => $technicianId, 'technicianDescription' => $technicianDescription, 'reportId' => $reportId]
        );
    }
}
