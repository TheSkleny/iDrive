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
        select
  "LK"."Id" as "LinkId",
  "LN"."Name" as "LineName",
  "LN"."Id" as "LineId",
  "VT"."Icon" as "VehicleIcon",
  "VL"."Name" as "VehicleName",
  "LK"."DepartureTime",
  (
    select
      "FS"."Name" as "FirstStop"
    from
      "LineStop" "LS"
      left join "Stop" "FS" on "LS"."StopId" = "FS"."Id"
    where
      "Order" = 1
    limit
      1
  ),
  (
    select
      "LSS"."Name" as "LastStop"
    from
      "LineStop" "LS"
      left join "Stop" "LSS" on "LS"."StopId" = "LSS"."Id"
    order by
      "LS"."Order" desc
    limit
      1
  )
from
  "Link" "LK"
  left join "Line" "LN" on "LK"."LineId" = "LN"."Id"
  left join "Vehicle" "VL" on "LK"."VehicleId" = "VL"."Id"
  left join "users" "DR" on "LK"."DriverId" = "DR"."id"
  left join "VehicleType" "VT" on "VL"."TypeId" = "VT"."Id"
where
  "DR"."id" = :driverId
    ', ['driverId' => $driverId]);
    }
}
