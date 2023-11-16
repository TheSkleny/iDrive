<?php

namespace App\Repositories;

use App\Models\Line;

class SearchLineRepository
{
    public function getLineList()
    {
        $line = Line::join('VehicleType', 'Line.TypeId', '=', 'VehicleType.Id')
                    ->select('Line.Id', 'Line.Name', 'VehicleType.Id as VehicleTypeId', 'VehicleType.Description')->get();
        if ($line) {
            return $line;
        }
        return null;
    }
}
