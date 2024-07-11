<?php

return [

    'failed' => 'Estas credenciales no están registradas.',
    'password' => 'La contraseña proporcionada es incorrecta.',
    'throttle' => 'Demasiados intentos. Por favor intente de nuevo en :seconds segundos.',
    'custom' => [
        'certificado' => [
            'required' => 'El certificado es obligatorio.',
        ],
        'firma' => [
            'required' => 'La firma es obligatoria.',
        ],
        'email' => [
            'required' => 'El email es obligatorio.',
            'email' => 'El email debe ser una dirección válida.',
        ],
        'password' => [
            'required' => 'La contraseña es obligatoria.',
            'min' => 'La contraseña debe tener al menos :min caracteres.',
        ],
    ],
    'attributes' => [
        'certificado' => 'certificado',
        'firma' => 'firma',
        'email' => 'correo electrónico',
        'password' => 'contraseña',
    ],

];
