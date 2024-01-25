<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Children extends Enum
{

    const Ja = 'Ja';
    const Nej = 'Nej';
    const IkkeOplyst = 'Ikke oplyst'; //Ikke oplyst
    const Hjemmeboende = 'Hjemmeboende'; //hjemmeboende
    const JaUdeboende = 'Ja, udeboende'; //Ja, udeboende
}
