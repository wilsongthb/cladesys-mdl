<?php

return [
    'per_page' => 25,
    'menu' => [
        'Herramientas' => [
            'icon' => '<i class="fa fa-cog"></i>',
            'list' => [
                'Productos' => 'logistic/products',
                'Configuracion de Productos' => 'logistic/products-config',
                'Proveedores' => 'logistic/suppliers',
                'Components' => 'logistic/components'
            ]
            ],
            'Kardex' => [
                'icon' => '<i class="fa fa-tasks"></i>',
                'list' => [
                    'Entradas' => 'logistic/inputs',
                    'Salidas' => 'logistic/outputs',
                ]
            ]
    ],
    'location' => [
        'default_id' => 1,
        'type' => [
            1 => 'ALMACEN',
            /**
                Puede registra entradas y salidas
                Puede generar comprobantes
                Puede hacer costeos,
                Puede hacer requerimientos
                Puede ver requerimientos de las sucursales u otros almacenes
            */
            2 => 'SUCURSAL'
            /**
                Puede registrar salidas
                Puede hacer requerimientos
            */
        ],
    ],
    'doc' => [
        'type' => [
            1 => 'DNI',
            2 => 'RUC'
        ]
    ],
    'ticket' => [
        'type' => [
            1 => 'BOLETA',
            2 => 'FACTURA'
        ]
    ],
    'order' => [
        'status' => [
            1 => 'REQUERIMIENTO',
            2 => 'COTIZACION',
            3 => 'ORDEN DE COMPRA',
        ]
    ],
    'inputs' => [
        'type' => [
            1 => 'ENTRADA',
            2 => 'DISTRIBUCION',
        ],
        'status' => [
            1 => 'ACTIVO',
            2 => 'BLOQUEADO',
        ]
    ],
    'outputs' => [
        'status' => [
            1 => 'ACTIVO',
            2 => 'ENVIADO/BLOQUEADO'
        ],
        'type' => [
            1 => 'SALIDA', //uso final
            2 => 'DISTRIBUCION', // enviado a otra localizacion
            3 => 'VENTA', // venta a una entidad
        ]
    ]
];
