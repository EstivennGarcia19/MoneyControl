<?php

use Carbon\Carbon;


function formatCOP($amount) {

    return number_format($amount, 0, ',', ',');

}

function formatFullDate($date) {
    
    Carbon::setLocale('es');
    
    $lowerCase = Carbon::parse($date)->isoFormat('dddd, DD MMM YYYY HH:mm');

    return ucfirst($lowerCase);

}


function formatMonthDate($date) {

    Carbon::setLocale('es');

    $fechaCarbon = Carbon::parse($date);

// Obtener el nombre del mes en español y en mayúsculas
    return strtoupper($fechaCarbon->translatedFormat('F'));

}

function formatDate($date) {

    Carbon::setLocale('es');

    $lowerCase = Carbon::parse($date)->isoFormat('dddd DD [de] MMMM');

    return ucfirst($lowerCase);

}


