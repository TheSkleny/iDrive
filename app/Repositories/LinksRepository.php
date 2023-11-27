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
        where "Link"."DriverId" is not null and "Link"."VehicleId" is not null
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
        where "Link"."DriverId" is null and "Link"."VehicleId" is null
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

    public function createLink($lineId, $departureDate) {
        DB::insert('
            insert into "Link" ("LineId", "DepartureDate", "VehicleId", "DriverId")
            values (:lineId, :departureDate, NULL, NULL)
        ', [
            'lineId' => $lineId,
            'departureDate' => $departureDate
        ]);
    }

    public function deleteLink($linkId) {
        DB::delete('
            delete from "Link"
            where "Id" = :linkId
        ', [
            'linkId' => $linkId
        ]);
    }

    public function updateLink($linkId, $lineId, $departureDate) {
        DB::update('
            update "Link"
            set
                "LineId" = :lineId,
                "DepartureDate" = :departureDate,
                "VehicleId" = NULL,
                "DriverId" = NULL
            where "Id" = :linkId
        ', [
            'linkId' => $linkId,
            'lineId' => $lineId,
            'departureDate' => $departureDate
        ]);
    }
}
