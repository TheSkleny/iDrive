<?php

namespace App\Enums;

enum VehicleTypeEnum: int
{
    case TRAMVAJ = 1;
    case TROLEJBUS = 2;
    case AUTOBUS = 3;
    case METRO = 4;
    case LOD = 5;
    case VLAK = 6;
    case LETADLO = 7;
}