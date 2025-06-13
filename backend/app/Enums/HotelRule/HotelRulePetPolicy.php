<?php

namespace App\Enums\HotelRule;


use App\Support\Enum;

enum HotelRulePetPolicy: int
{
    use Enum;

    case NotAllowed = 0;
    case Allowed = 1;


}
