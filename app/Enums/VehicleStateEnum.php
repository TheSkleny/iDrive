<?php

namespace App\Enums;

enum VehicleStateEnum: int
{
    case OPERATIONAL = 1;
    case AT_SERVICE_STATION = 2;
    case OUT_OF_SERVICE = 3;
}