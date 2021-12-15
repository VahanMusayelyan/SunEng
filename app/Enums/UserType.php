<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class UserType extends Enum
{
    const ADMIN =   0;
    const TEACHER =   1;
    const STUDENT = 2;

    const ADMINHASH = "i4need6994teach89234english3645474";
}
