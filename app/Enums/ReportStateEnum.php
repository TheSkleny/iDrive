<?php

namespace App\Enums;

enum ReportStateEnum: int
{
    case REPORTED = 1;
    case REJECTED = 2;
    case ASSIGNED_TO_TECHNITIAN = 3;
    case FINISHED = 4;
}