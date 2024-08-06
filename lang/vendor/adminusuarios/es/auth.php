<?php

return [

    'failed' => 'Estas credenciales no están registradas.',
    'password' => 'La contraseña proporcionada es incorrecta.',
    'throttle' => 'Demasiados intentos. Por favor intente de nuevo en :seconds segundos.',
    'custom' => [
        'certificado' => [
            'required' => 'El :attribute es obligatorio.',
        ],
        'firma' => [
            'required' => 'La :attribute es obligatoria.',
        ],
        'email' => [
            'required' => 'El :attribute es obligatorio.',
            'email' => 'El :attribute debe ser una dirección válida.',
        ],
        'password' => [
            'required' => 'La :attribute es obligatoria.',
            'min' => 'La :attribute debe tener al menos :min caracteres.',
        ],
    ],
    'attributes' => [
        'certificado' => 'certificado',
        'firma' => 'firma',
        'email' => 'correo electrónico',
        'password' => 'contraseña',
    ],

];
