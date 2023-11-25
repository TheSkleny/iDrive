<?php

namespace App\Repositories;

use App\Models\Line;
use Illuminate\Support\Facades\DB;
use App\Models\LineStop;


class LineDetailRepository {
    public function getLineStops($lineId) {
        $q_stops =  DB::select('
        select
            "LS"."Id" as "LineStopId",
            "LS"."Order",
            "S"."Name"
        from
            "LineStop" "LS"
            left join "Stop" "S" on "LS"."StopId" = "S"."Id"
        where
            "LS"."LineId" = :lineId
        order by
            "LS"."Order"
            ', ['lineId' => $lineId]);

        $q_detail = DB::select('
        select
        "LN"."Name" as "LineName",
        "VT"."Icon" as "LineIcon"
        from "Line" "LN"
        left join "VehicleType" "VT" on "LN"."TypeId" = "VT"."Id"
        where "LN"."Id" = :lineId', ['lineId' => $lineId]);

        return [
            'LineName' => $q_detail[0]->LineName,
            'VehicleTypeIcon' => $q_detail[0]->LineIcon,
            'Stops' => $q_stops
        ];

    }
    public function getLineMatrixData($lineId) {
        return DB::select('
        SELECT
            "S1"."Name" AS "CurrStop",
            "S2"."Name" AS "NextStop",
            "T"."TimeBetweenStops" AS "TTNS",
            "LS"."Order",
            "LK"."DepartureDate"
        FROM "LineStop" "LS"
        JOIN "Line" "L" ON "LS"."LineId" = "L"."Id"
        JOIN "Stop" "S1" ON "LS"."StopId" = "S1"."Id"
        LEFT JOIN "LineStop" "LS2" ON "LS"."LineId" = "LS2"."LineId" AND "LS"."Order" + 1 = "LS2"."Order"
        LEFT JOIN "Stop" "S2" ON "LS2"."StopId" = "S2"."Id"
        LEFT JOIN "TimeBetweenStops" "T" ON "S1"."Id" = "T"."FirstStopId" AND "S2"."Id" = "T"."SecondStopId"
        LEFT JOIN "Link" "LK" ON "L"."Id" = "LK"."LineId"
        WHERE "L"."Id" = :lineId
        ORDER BY "LK"."DepartureDate", "LS"."Order"
    ', ['lineId' => $lineId]);
    }
}
