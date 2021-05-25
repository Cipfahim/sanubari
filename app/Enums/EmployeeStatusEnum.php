<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Draft()
 * @method static static Active()
 * @method static static Inactive()
 */
final class EmployeeStatusEnum extends Enum
{
    const Draft = 'draft';
    const Active = 'active';
    const Inactive = 'inactive';
}
