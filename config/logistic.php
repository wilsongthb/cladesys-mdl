<?php

return [
    'per_page' => 25,
    'name' => 'logistic',
    'menu' => [
        'Utilitarios' => [
            'icon' => '<i class="fa fa-cog"></i>',
            'list' => [
                'Usuarios' => '',
                'Contraseñas' => '',
                'Configuración de la aplicación' => '',
            ]
        ],
        'Productos' => [
            'icon' => '<i class="fa fa-book"></i>',
            'list' => [
                'Productos' => '/products',
                'Configuracion de Productos' => '/products-config',
            ]
        ],
        'Compra' => [
            'icon' => '<i class="fa fa-envelope"></i>',
            'list' => [
                'Requerimientos' => '/requeriments',
                'Cotización' => '/quotations',
                'Comparación' => '/comparison',
                'Compra' => '/purchase',
                'Ingreso a Almacén' => '/inputs'
            ]
        ],
        'Distribución' => [
            'icon' => '<i class="fa fa-tasks"></i>',
            'list' => [
                'Destino Area' => '/outputs',
                'Venta/Uso Final' => '/outputs',
            ]
        ],
        'Reportes' => [
            'icon' => '<i class="fa fa-info"></i>',
            'list' => [
                'Stock Actual' => '/stock-location',
                'Stock y Configuracion de Productos' => '/stock-location-po',
                'Inventario General' => '/inventory-general',
                'Estado del Stock' => '/stock-status',
            ]
        ],
        'Contactos' => [
            'icon' => '<i class="fa fa-book"></i>',
            'list' => [
                'Proveedores' => '/suppliers'
            ]
        ]
    ],
    'location' => [
        'default_id' => 1,
        'type' => [
            1 => 'ALMACEN',
            /**
             *   Puede registra entradas y salidas
             *   Puede generar comprobantes
             *   Puede hacer costeos,
             *   Puede hacer requerimientos
             *   Puede ver requerimientos de las sucursales u otros almacenes
            */
            2 => 'SUCURSAL'
            /**
             *   Puede registrar salidas
             *   Puede hacer requerimientos
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
            1 => 'USO FINAL', //uso final
            2 => 'DISTRIBUCION', // enviado a otra localizacion
            3 => 'VENTA', // venta a una entidad
        ]
    ]
];
