<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasUuids;
use Illuminate\Database\Eloquent\Model;

class TimeBetweenStops extends Model
{
    use HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'TimeBetweenStops';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'FirstStopId',
        'SecondStopId',
        'TransferTime'
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
}
