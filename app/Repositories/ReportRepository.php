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

    public function getReportByTechnicianId($technicianId) : array
    {
        return DB::select('
            select
        "R"."Id" as "ReportId",
        "R"."ReportDate" as "ReportDate",
        "R"."TypeId" as "ReportTypeId",
        "R"."MaintenanceDate" as "ReportMaintenanceDate",
        "U"."name" as "SubmitterName",
        "VL"."Id" as "VehicleId",
        "VL"."Name" as "VehicleName",
        "VL"."LicensePlate" as "VehicleLicensePlate",
        "VL"."LastMaintenance" as "VehicleLastMaintenance",
        "VT"."Icon" as "VehicleIcon"
        from
        "Report" "R"
        left join "users" "U" on "R"."SubmitterId" = "U"."Id"
        left join "Vehicle" "VL" on "R"."VehicleId" = "VL"."Id"
        left join "VehicleType" "VT" on "VL"."TypeId" = "VT"."Id"
        where
            "TechnicianId" = :technicianId
        and "R"."StateId" = 3
        order by "R"."MaintenanceDate"
        ', ['technicianId' => $technicianId]
        );
    }

    public function getReportsByStateWithVehicleInfo($stateId) : array
    {
        return DB::select('
        select
        "R"."Id" as "ReportId",
        "R"."ReportDate" as "ReportDate",
        "U"."name" as "SubmitterName",
        "VL"."Id" as "VehicleId",
        "VL"."Name" as "VehicleName",
        "VL"."LicensePlate" as "VehicleLicensePlate",
        "VL"."LastMaintenance" as "VehicleLastMaintenance",
        "VT"."Icon" as "VehicleIcon"
        from
        "Report" "R"
        left join "users" "U" on "R"."SubmitterId" = "U"."Id"
        left join "Vehicle" "VL" on "R"."VehicleId" = "VL"."Id"
        left join "VehicleType" "VT" on "VL"."TypeId" = "VT"."Id"
        where
        "R"."StateId" = :stateId
        order by "R"."ReportDate"
        ', ['stateId' => $stateId]
        );
    }
    public function getReportById($reportId) : array
    {
        return DB::select('
            select
        "R"."Id" as "ReportId",
        "R"."ReportDate" as "ReportDate",
        "R"."Description" as "ReportDescription",
        "R"."MaintenanceDate" as "ReportMaintenanceDate",
        "R"."StateId" as "ReportStateId",
        "U"."name" as "SubmitterName",
        "VL"."Id" as "VehicleId",
        "VL"."Name" as "VehicleName",
        "VL"."LicensePlate" as "VehicleLicensePlate",
        "VL"."LastMaintenance" as "VehicleLastMaintenance",
        "VT"."Icon" as "VehicleIcon"
        from
        "Report" "R"
        left join "users" "U" on "R"."SubmitterId" = "U"."Id"
        left join "Vehicle" "VL" on "R"."VehicleId" = "VL"."Id"
        left join "VehicleType" "VT" on "VL"."TypeId" = "VT"."Id"
        where
         "R"."Id" = :reportId
        ', ['reportId' => $reportId]
        );
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
    public function handleReport($reportId, $technicianId, $maintenanceDate, $decision) {
        if ($decision == 'accept') {
            DB::update('
                update "Report"
                set
                    "StateId" = 3,
                    "TechnicianId" = :technicianId,
                    "MaintenanceDate" = :maintenanceDate
                where "Id" = :reportId
            ', ['technicianId' => $technicianId, 'maintenanceDate' => $maintenanceDate, 'reportId' => $reportId]
            );
        }
        else if ($decision == 'reject') {
            DB::update('
                update "Report"
                set "StateId" = 2
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
