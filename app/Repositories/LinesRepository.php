<?php

namespace App\Repositories;

use App\Models\Line;
use Illuminate\Support\Facades\DB;


class LinesRepository {
    public function getLines() {
        return DB::select('
            select
                "Line"."Id" as "LineId",
                "Line"."Name" as "LineName",
                "VehicleType"."Description" as "LineType",
                "Line"."TypeId" as "LineTypeId"
            from "Line"
                left join "VehicleType" on "Line"."TypeId" = "VehicleType"."Id"
        ');
    }

    public function createLine($lineName, $lineTypeId) {
        DB::insert('
            insert into "Line" ("Name", "TypeId")
            values (:lineName, :lineTypeId)
        ', [
            'lineName' => $lineName,
            'lineTypeId' => $lineTypeId
            ]
        );
    }
    public function createLineStops($lineName, $stopName1, $stopName2, $timeBetweenStops, $order) {
        DB::insert('
            insert into "LineStop" ("LineId", "StopId", "Order")
            values ((select "Id" from "Line" where "Name" = :lineName), (select "Id" from "Stop" where "Name" = :stopName), :order)
        ', [
            'lineName' => $lineName,
            'stopName' => $stopName1,
            'order' => $order
            ]
        );
        DB::insert('
            insert into "LineStop" ("LineId", "StopId", "Order")
            values ((select "Id" from "Line" where "Name" = :lineName), (select "Id" from "Stop" where "Name" = :stopName), :order)
        ', [
            'lineName' => $lineName,
            'stopName' => $stopName2,
            'order' => $order + 1
            ]
        );
        DB::insert('
            insert into "Stop" ("Name")',
            ['stopName' => $stopName1]
        );
        DB::insert('
            insert into "Stop" ("Name")',
            ['stopName' => $stopName2]
        );
        DB::insert('
            insert into "TimeBetweenStops" ("FirstStopId", "SecondStopId", "TimeBetweenStops")
            values ((select "Id" from "Stop" where "Name" = :stopName1), (select "Id" from "Stop" where "Name" = :stopName2), :timeBetweenStops)
            ', [
                'stopName1' => $stopName1,
                'stopName2' => $stopName2,
                'timeBetweenStops' => $timeBetweenStops
            ]
        );
    }

    public function updateLine($lineId, $lineName, $lineTypeId) {
        DB::update('
            update "Line"
            set
                "Name" = :lineName,
                "TypeId" = :lineTypeId
            where "Id" = :lineId
        ', [
            'lineId' => $lineId,
            'lineName' => $lineName,
            'lineTypeId' => $lineTypeId
        ]);
    }

    public function updateLineStops($lineName, $stopName1, $stopName2, $timeBetweenStops, $order) {
        DB::update('
            update "LineStop"
            set
                "LineId" = (select "Id" from "Line" where "Name" = :lineName),
                "StopId" = (select "Id" from "Stop" where "Name" = :stopName),
                "Order" = :order
            where "LineId" = (select "Id" from "Line" where "Name" = :lineName)
        ', [
            'lineName' => $lineName,
            'stopName' => $stopName1,
            'order' => $order
            ]
        );
        DB::update('
            update "LineStop"
            set
                "LineId" = (select "Id" from "Line" where "Name" = :lineName),
                "StopId" = (select "Id" from "Stop" where "Name" = :stopName),
                "Order" = :order
            where "LineId" = (select "Id" from "Line" where "Name" = :lineName)
        ', [
            'lineName' => $lineName,
            'stopName' => $stopName2,
            'order' => $order + 1
            ]
        );
        DB::update('
            update "Stop"
            set
                "Name" = :stopName
            where "Name" = :stopName
        ', [
            'stopName' => $stopName1
            ]
        );
        DB::update('
            update "Stop"
            set
                "Name" = :stopName
            where "Name" = :stopName
        ', [
            'stopName' => $stopName2
            ]
        );
        DB::update('
            update "TimeBetweenStops"
            set
                "FirstStopId" = (select "Id" from "Stop" where "Name" = :stopName1),
                "SecondStopId" = (select "Id" from "Stop" where "Name" = :stopName2),
                "TimeBetweenStops" = :timeBetweenStops
            where "FirstStopId" = (select "Id" from "Stop" where "Name" = :stopName1)
        ', [
            'stopName1' => $stopName1,
            'stopName2' => $stopName2,
            'timeBetweenStops' => $timeBetweenStops
            ]
        );
    }

    public function deleteLine($lineId) {
        DB::delete('
            delete from "LineStop"
            where "LineId" = :lineId
        ', ['lineId' => $lineId]);
    }
}
