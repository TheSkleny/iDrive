<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
//use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Expression;

use App\Models\User;
use App\Models\Line;
use App\Models\LineStop;
use App\Models\Stop;
use App\Models\Vehicle;
use App\Models\VehicleType;


class DriverRepository
{
    public function getDriverShifts($driverId) : array
    {
        return DB::select('
        SELECT
        "LK"."Id" AS "LinkId",
        "LN"."Name" AS "LineName",
        "VT"."Icon" AS "VehicleIcon",
        "VL"."Name" AS "VehicleName",
        "LK"."DepartureTime",
        (
            SELECT "FS"."Name" AS "FirstStop"
            FROM "LineStop" "LS"
            LEFT JOIN "Stop" "FS"
            ON "LS"."StopId" = "FS"."Id"
            WHERE "Order" = 1
        ),
        (
            SELECT "LSS"."Name" AS "LastStop"
            FROM "LineStop" "LS"
            LEFT JOIN "Stop" "LSS"
            ON "LS"."StopId" = "LSS"."Id"
            ORDER BY "LS"."Order" DESC
            LIMIT 1
        )
        FROM "Link" "LK"
        LEFT JOIN "Line" "LN"
        ON "LK"."LineId" = "LN"."Id"
        LEFT JOIN "Vehicle" "VL"
        ON "LK"."VehicleId" = "VL"."Id"
        LEFT JOIN "users" "DR"
        ON "LK"."DriverId" = "DR"."id"
        LEFT JOIN "VehicleType" "VT"
        ON "VL"."TypeId" = "VT"."Id"
        WHERE "DR"."id" = :driverId
    ', ['driverId' => $driverId]);
    }
}
