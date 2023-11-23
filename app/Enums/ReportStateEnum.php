<?php

namespace App\Enums;

enum ReportStateEnum
{
    const REPORTED = 1;
    const REJECTED = 2;
    const ASSIGNED_TO_TECHNITIAN = 3;
    const FINISHED = 4;
}