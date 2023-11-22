<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

use App\Models\Vehicle;
use App\Models\VehicleType;
use App\Models\VehicleState;
use App\Models\Report;

class VehicleRepository
{
    public function getVehicleInfo($vehicleId) : array
    {
        return DB::select('
        select
        "VL"."Id" as "VehicleId",
        "VL"."Name" as "VehicleName",
        "VL"."Brand" as "VehicleBrand",
        "VL"."ImageUri" as "VehicleImageUri",
        "VL"."LastMaintenance" as "VehicleLastMaintenance",
        "VL"."Capacity" as "VehicleCapacity",
        "VL"."SpeedLimit" as "VehicleSpeedLimit",
        "VL"."LicensePlate" as "VehicleLicensePlate",
        "VT"."Description" as "VehicleTypeDescription",
        "VT"."Icon" as "VehicleTypeIcon",
        "VS"."Description" as "VehicleStateDescription"
        from
        "Vehicle" as "VL"
        left join "VehicleType" as "VT" on "VL"."TypeId" = "VT"."Id"
        left join "VehicleState" as "VS" on "VL"."StateId" = "VS"."Id"
        where "VL"."Id" = :vehicleId
        ', ['vehicleId' => $vehicleId]);
    }
    public function reportVehicleMalfunction($submitterId, $description, $vehicleId) : void
    {
        // TODO - rename DriverId to SubmitterId and DriverDescription to Description
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
                    :description, 
                    :vehicleId, 
                    NULL,
                    NULL, 
                    NULL, 
                    1, 
                    1
                )
        ', ['submitterId' => $submitterId, 'description' => $description, 'vehicleId' => $vehicleId]);
    }
}
