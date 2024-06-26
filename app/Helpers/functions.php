<?php

require_once 'Filament/functions.php';

function convertArrayToIntegers($array): array
{
    return array_map(fn($value) => intval($value), $array);
}
