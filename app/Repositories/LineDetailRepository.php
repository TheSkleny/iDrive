<?php

namespace App\Repositories;

use App\Models\Line;
use Illuminate\Support\Facades\DB;
use App\Models\LineStop;


class LineDetailRepository
{
    public function getLineStops($lineId)
    {
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
        "LN"."Name" as "LineName"
        from "Line" "LN"
        where "LN"."Id" = :lineId', ['lineId' => $lineId]);

        return [
            'LineName' => $q_detail[0]->LineName,
            'Stops' => $q_stops
        ];

    }


}