<?php

namespace App\Enums;

enum ProjectType: string
{
    case HOURLY = 'HOURLY';
    case FIXED = 'FIXED';
    case INTERNAL = 'INTERNAL';
}
