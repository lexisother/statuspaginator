<?php

namespace App\Enums;

enum SiteType: string
{
    case Production = 'production';
    case Staging = 'staging';
}
