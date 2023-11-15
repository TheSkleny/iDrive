<?php

namespace App\Repositories;

use App\Interfaces\ReportTypeRepositoryInterface;
use App\Models\ReportType;

class ReportTypeRepository implements ReportTypeRepositoryInterface
{
    public function getAll()
    {
        return ReportType::all();
    }
}
