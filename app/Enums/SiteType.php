<?php

namespace App\Enums;

enum SiteType: string
{
    case PRODUCTION = 'production';
    case STAGING = 'staging';
}
