<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\VehicleStateEnum;
use App\Enums\VehicleTypeEnum;

class Vehicle extends Model
{
    use HasUuids, HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Vehicle';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Name',
        'Brand',
        'ImageUri',
        'LastMaintenance',
        'Capacity',
        'SpeedLimit',
        'LicensePlate',
        'TypeId',
        'StateId'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'LastMaintenance' => 'date',
        'TypeId' => VehicleTypeEnum::class,
        'StateId' => VehicleStateEnum::class,
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
