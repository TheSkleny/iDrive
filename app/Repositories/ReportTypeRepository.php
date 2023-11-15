<?php

namespace App\Repositories;

use App\Models\ReportType;

class ReportTypeRepository
{
    public function getAll()
    {

        return ReportType::all();
    }
}