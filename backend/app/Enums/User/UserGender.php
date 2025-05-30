<?php

namespace App\Enums\User;


use App\Support\Enum;

enum UserGender: int
{
    use Enum;

    case Male = 0;
    case Female = 1;

}
