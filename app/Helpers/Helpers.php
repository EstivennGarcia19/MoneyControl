<?php

use Carbon\Carbon;


function formatCOP($amount) {

    return number_format($amount, 0, ',', ',');

}

function formatFullDate($date) {
    
    Carbon::setLocale('es');
    
    $lowerCase = Carbon::parse($date)->isoFormat('ddd DD MMM YYYY');

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



function getIconClass($name) {

    $icons = [
        'Alimento' => 'fa-burger',
        'Salud y belleza' => 'fa-spray-can-sparkles',
        'Entretenimiento y caprichos' => 'fa-gift',
        'Inversiones y apuestas' => 'fa-toilet-paper"',
        'Limpieza y hogar' => 'fa-toilet-paper',
        'Transporte' => 'fa-bus',
        'Facturas' => 'fa-receipt',
        'Mascotas' => 'fa-paw',
        'Ropa y calzado' => 'fa-bag-shopping',
        'Otros' => 'fa-ellipsis',
    ];

    return $icons[$name] ?? 'bx-category';
}


