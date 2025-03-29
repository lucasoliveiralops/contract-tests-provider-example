<?php

declare(strict_types=1);

namespace App\DTO;

use App\Enum\Gender;

class UserFilter
{
    public function __construct(
        public readonly ?int $age = null,
        public readonly ?Gender $gender = null,
    ) {
    }
}
