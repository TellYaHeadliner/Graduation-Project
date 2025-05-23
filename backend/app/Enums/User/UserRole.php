<?php

namespace App\Enums\User;


use App\Support\Enum;

enum UserRole: int
{
    use Enum;

    case Admin = 1;
    case Customer = 2;
    case Owner = 3;


}
