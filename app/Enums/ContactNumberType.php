<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ContactNumberType extends Enum
{
    const Home = "Home";
    const Mobile = "Mobile";
    const Office = "Office";
    const Wife = "Wife";
    const Husbend = "Husbend";
    const Children = "Children";
    const Friends = "Friends";
    const Parents = "Parents";
}
