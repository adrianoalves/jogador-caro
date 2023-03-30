<?php

namespace App\Models\Concerns;

Enum Position: string
{
    use IteratesOverCases;

    case GOALKEEPER = 'goleiro';

    case DEFENDER   = 'zagueiro';

    case MIDFIELD   =  'meio campo';

    case BACK_MIDFIELD = 'volante';

    case OFFENSIVE_MIDFIELD = 'meia armador';

    case LEFT_BACK = 'lateral esquerdo';

    case RIGHT_BACK = 'lateral direito';

    case STRIKER = 'atacante';
}
