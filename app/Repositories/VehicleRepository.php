<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

use App\Models\Vehicle;
use App\Models\VehicleType;
use App\Models\VehicleState;
use App\Models\Report;

class VehicleRepository
{
    public function getVehiclesByState($StateId) : array
    {
        return DB::select('
        select
        "VL"."Id" as "VehicleId",
        "VL"."Name" as "VehicleName",
        "VL"."LicensePlate" as "VehicleLicensePlate",
        "VL"."LastMaintenance" as "VehicleLastMaintenance",
        "VT"."Icon" as "VehicleIcon",
        "VS"."Id" as "VehicleStateId",
        "VS"."Description" as "VehicleStateDescription"
        from
        "Vehicle" as "VL"
        left join "VehicleType" as "VT" on "VL"."TypeId" = "VT"."Id"
        left join "VehicleState" as "VS" on "VL"."StateId" = "VS"."Id"
        where "VL"."StateId" = :StateId
        ', ['StateId' => $StateId]);

    }
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
    public function addVehicle($name, $brand, $imageUri, $capacity, $speedLimit, $licensePlate, $typeId) : void
    {
        DB::insert('
            insert into "Vehicle"
                (
                    "Name",
                    "Brand",
                    "ImageUri",
                    "LastMaintenance",
                    "Capacity",
                    "SpeedLimit",
                    "LicensePlate",
                    "TypeId",
                    "StateId"
                )
            values
                (
                    :name,
                    :brand,
                    :imageUri,
                    NULL,
                    :capacity,
                    :speedLimit,
                    :licensePlate,
                    :typeId,
                    1
                )
        ', ['name' => $name, 'brand' => $brand, 'imageUri' => $imageUri, 'capacity' => $capacity, 'speedLimit' => $speedLimit, 'licensePlate' => $licensePlate, 'typeId' => $typeId]);
    }
    public function updateVehicleInfo($vehicleId, $name, $brand, $imageUri, $capacity, $speedLimit, $licensePlate, $typeId) : void
    {
        DB::update('
            update "Vehicle"
            set
                "Name" = :name,
                "Brand" = :brand,
                "ImageUri" = :imageUri,
                "Capacity" = :capacity,
                "SpeedLimit" = :speedLimit,
                "LicensePlate" = :licensePlate,
                "TypeId" = :typeId
            where "Id" = :vehicleId
        ', ['vehicleId' => $vehicleId, 'name' => $name, 'brand' => $brand, 'imageUri' => $imageUri, 'capacity' => $capacity, 'speedLimit' => $speedLimit, 'licensePlate' => $licensePlate, 'typeId' => $typeId]);
    }
    public function deleteVehicle($vehicleId) : void
    {
        DB::delete('
            delete from "Vehicle"
            where "Id" = :vehicleId
        ', ['vehicleId' => $vehicleId]);
    }
}
