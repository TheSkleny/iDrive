<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Report';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ReportDate',
        'DriverId',
        'DriverDescription',
        'VehicleId',
        'TechnicianId',
        'TechnicianDescription',
        'MaintenanceDate',
        'StateId',
        'TypeId'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
    * The primary key associated with the table.
    *
    * @var string
    */
    protected $primaryKey = 'Id';
    protected $keyType = 'string';
}
