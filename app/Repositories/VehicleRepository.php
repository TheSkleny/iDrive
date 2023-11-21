<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

use App\Models\Vehicle;

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
}
