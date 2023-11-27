<?php

namespace App\Enums;

enum UserTypeEnum : int
{
    case DRIVER = 1;
    case DISPATCHER = 2;
    case TECHNICIAN = 3;
    case SUPERVISOR = 4;
    case ADMIN = 5;
    case REGISTERED = 6;
}
