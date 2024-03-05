<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class CivilStatus extends Enum
{
    const Single = 'Single';
    const IEtForhold = 'I et forhold'; //i et forhold
    const IkkeOplyst = 'Ikke oplyst'; //ikke oplyst
    const Gift = 'Gift';
    const Separeret = 'Separeret';
    const Skilt = 'Skilt';
    const ÅbentForhold = 'Åbent forhold'; //Åbent forhold
}
