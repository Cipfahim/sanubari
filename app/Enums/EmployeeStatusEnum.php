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
    const Draft = 'Draft';
    const Active = 'Active';
    const Inactive = 'Inactive';
}
