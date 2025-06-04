<?php

namespace Modules\Job\Domain\ValueObjects\Enum;

enum EmploymentStatus: int
{
    case FULL_TIME = 1;
    case PART_TIME = 2;
}
