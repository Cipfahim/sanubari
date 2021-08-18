<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ContactAddressType extends Enum
{
    const Home = "Home";
    const Office = "Office";
    const Neighbour = "Neighbour";
    const Parents = "Parents";
}
