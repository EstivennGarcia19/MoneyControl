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
        'Alimento' => 'bxs-baguette',
        'Salud y belleza' => 'bxs-spray-can',
        'Tecnologia' => 'bx-joystick-alt',
        'Negocios y apuestas' => 'bxl-bitcoin',
        'Hogar' => 'bxs-home-smile',
        'Transporte' => 'bxs-bus',
        'Facturas' => 'bxs-receipt',
        'Mascotas' => 'bxs-dog',
        'Ropa y accesorios' => 'bxs-shopping-bag',
        'Otros' => 'bx-menu',
    ];

    return $icons[$name] ?? 'bx-category';
}


