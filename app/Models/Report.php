<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\ReportStateEnum;
use App\Enums\ReportTypeEnum;

class Report extends Model
{
    use HasUuids, HasFactory;

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
        'SubmitterId',
        'Description',
        'VehicleId',
        'TechnicianId',
        'TechnicianDescription',
        'MaintenanceDate',
        'StateId',
        'TypeId'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'ReportDate' => 'date',
        'MaintenanceDate' => 'date',
        'StateId' => ReportStateEnum::class,
        'TypeId' => ReportTypeEnum::class,
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
