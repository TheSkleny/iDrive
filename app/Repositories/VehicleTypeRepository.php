<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\VehicleType;

class VehicleTypeRepository
{
    public function getVehicleTypeList()
    {
        return DB::select('SELECT "Id", "Description", "Icon" FROM "VehicleType"');
    }
}
