<?php

namespace App\Models\Enums;

use App\Models\Concerns\IteratesOverCases;

/**
 * Backed Enum to define common statuses
 */
Enum UserStatus: string
{
    use IteratesOverCases;

    case ACTIVE = 'ativo';

    case INJURIED = 'machucado';

    case SUSPENDED = 'suspenso';

    case RETIRED = 'aposentado';

    case DEACTIVATED = 'inativo';
}
