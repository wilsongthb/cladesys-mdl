<?php
/**
*    CONFIGURACIONES PARA DESARROLLO
*    ===============================
*    Estas configuraciones se modifican constantemente
*    para propositos de prueba
*/
return [
    'logistic' => [
        'inventory_mintoshow' => -9999999
    ],
    'instrument_history' => [
        'status' => [
            1 => 'ENTREGADO',
            2 => 'DEVUELTO'
        ]
    ],
    'credential' => [
        'modules' => []
    ],
    'user_config' => [
        // valores por defecto de la configuracion de usuario de logistica
        'logistic' => [
            'theme' => 'bootstrap',
            // 'theme' => 'gentelella',
            // 'theme' => 'mui',
        ]
    ],
];