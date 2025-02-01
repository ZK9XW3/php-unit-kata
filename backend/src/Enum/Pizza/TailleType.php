<?php

declare(strict_types=1);

namespace App\Enum\Pizza;

enum TailleType: string
{
    case PETITE = 'petite';
    case MOYENNE = 'moyenne';
    case GRANDE = 'grande';
}
