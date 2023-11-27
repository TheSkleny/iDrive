<?php

namespace App\Repositories;

use App\Models\Link;
use Illuminate\Support\Facades\DB;


class LinksRepository {
    public function getAllocatedLinks() {
        return DB::select('
        select
            "Link"."Id" as "LinkId",
            "Line"."Name" as "LineName",
            "Vehicle"."Name" as "VehicleName",
            "users"."name" as "DriverName",
            "Link"."DepartureDate" as "DepartureDate"
        from "Link"
            left join "Line" on "Link"."LineId" = "Line"."Id"
            left join "Vehicle" on "Link"."VehicleId" = "Vehicle"."Id"
            left join "users" on "Link"."DriverId" = "users"."Id"
        ');
    }

    public function getNonAllocatedLinks() {
        return DB::select('
        select
            "Link"."Id" as "LinkId",
            "Line"."Name" as "LineName",
            "Link"."DepartureDate" as "DepartureDate"
        from "Link"
            left join "Line" on "Link"."LineId" = "Line"."Id"
            left join "Vehicle" on "Link"."VehicleId" = "Vehicle"."Id"
            left join "users" on "Link"."DriverId" = "users"."Id"
        where "Link"."DriverId" is null
        ');
    }

    public function allocateLink($linkId, $driverId, $vehicleId) {
        DB::update('
            update "Link"
            set
                "DriverId" = :driverId,
                "VehicleId" = :vehicleId
            where "Id" = :linkId
        ', [
            'linkId' => $linkId,
            'driverId' => $driverId,
            'vehicleId' => $vehicleId
        ]);
    }
}
