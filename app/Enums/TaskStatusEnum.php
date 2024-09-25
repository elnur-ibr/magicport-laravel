<?php

declare(strict_types=1);

namespace App\Enums;

enum TaskStatusEnum: int
{
    case TODO        = 0;
    case IN_PROGRESS = 1;
    case DONE        = 2;
}
