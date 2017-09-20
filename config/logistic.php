<?php

return [
    'modules' => [
        'products' => [
            'title' => 'Registro de Productos',
            'description' => 'Modulo para registrar los productos',
            'api' => 'logistic/api/products',
            # ----------------------------------
            'icon' => '<i class="fa fa-book"></i>',
        ],
        'users' => [
            'title' => 'Usuarios',
            'description' => 'Modulo para gestionar los usuarios',
            'api' => 'users',
            # ----------------------------------
            'icon' => '<i class="fa fa-book"></i>',
        ],
        'permissions' => [
            'title' => 'Permisos',
            'description' => 'Modulo para configurar los usuarios y sus permisos',
            'api' => '',
            # ----------------------------------
            'icon' => '<i class="fa fa-book"></i>',
        ],
        'config' => [
            'title' => 'Configuracion',
            'description' => 'Configuraciones de la aplicacion',
            'api' => 'logistic/api/config',
            # ----------------------------------
            'icon' => '<i class="fa fa-book"></i>',
        ],
        'products-config' => [
            'title' => 'Configuracion de Productos',
            'description' => 'Configuraciones de los productos, individual por cada Area',
            'api' => 'logistic/api/product-options',
            # ----------------------------------
            'icon' => '<i class="fa fa-book"></i>',
        ],
        'requeriments' => [
            'title' => 'Requerimientos',
            'description' => 'Modulo para realizar un requerimiento, para solicitar productos que requiere un Area o para realizar un proceso de cotizacion segun el Area',
            'api' => 'logistic/api/requeriments',
            # ----------------------------------
            'icon' => '<i class="fa fa-book"></i>',
        ],
        'quotations' => [
            'title' => 'Cotizaciones',
            'description' => 'Modulo para realizar cotizaciones, la siguiente fase del proceso de compra por requerimientos',
            'api' => 'logistic/api/quotations',
            # ----------------------------------
            'icon' => '<i class="fa fa-book"></i>',
        ],
        'comparison' => [
            'title' => 'Comparaciones',
            'description' => 'Modulo para realizar comparaciones, permite relizar comparaciones entre los precios de diferentes proveedores registrados en la cotizaciòn',
            'api' => 'logistic/api/comparison',
            # ----------------------------------
            'icon' => '<i class="fa fa-book"></i>',
        ],
        'purchase' => [
            'title' => 'Compra',
            'description' => 'Modulo para generar ordenes de compra segun los productos de los proveedores seleccionados en la comparaciòn',
            'api' => 'logistic/api/purchase',
            # ----------------------------------
            'icon' => '<i class="fa fa-book"></i>',
        ],
        'inputs' => [
            'title' => 'Entradas a Almacén',
            'description' => 'Modulo para registrar productos que ingresan al almacén',
            'api' => 'logistic/api/inputs',
            # ----------------------------------
            'icon' => '<i class="fa fa-book"></i>',
        ],
        'outputs' => [
            'title' => 'Salidas del Almacén',
            'description' => 'Modulo para registrar productos que salen del almacén',
            'api' => 'logistic/api/outputs',
            # ----------------------------------
            'icon' => '<i class="fa fa-book"></i>',
        ],
        'inventory' => [
            'title' => 'Inventario',
            'description' => 'Modulo para registrar productos que salen del almacén',
            'api' => 'logistic/api/outputs',
            # ----------------------------------
            'icon' => '<i class="fa fa-book"></i>',
        ],
        'inventory-general' => [
            'title' => 'Inventario General',
            'description' => 'Modulo para registrar productos que salen del almacén',
            'api' => 'logistic/api/outputs',
            # ----------------------------------
            'icon' => '<i class="fa fa-book"></i>',
        ],
        'stock-status' => [
            'title' => 'Stock',
            'description' => 'Modulo para registrar productos que salen del almacén',
            'api' => 'logistic/api/outputs',
            # ----------------------------------
            'icon' => '<i class="fa fa-book"></i>',
        ],
        'suppliers' => [
            'title' => 'Proveedores',
            'description' => 'Modulo para registrar productos que salen del almacén',
            'api' => 'logistic/api/outputs',
            # ----------------------------------
            'icon' => '<i class="fa fa-book"></i>',
        ],
    ],
    'menu' => [
        // 'categories' => [
            'utilities' => [
                'title' => 'Utilitarios',
                'icon' => '<i class="fa fa-cog"></i>',
                'modules' => [
                    'users',
                    'permissions',
                    'config',
                ]
            ],
            'products' => [
                'title' => 'Productos',
                'icon' => '<i class="fa fa-book"></i>',
                'modules' => [
                    'products',
                    'products-config',
                ]
            ],
            'purchase' => [
                'title' => 'Compra',
                'icon' => '<i class="fa fa-envelope"></i>',
                'modules' => [
                    'requeriments',
                    // 'Requerimientos' => '/orders',
                    // 'Cotización' => 
                    'quotations',
                    // 'Comparación' => 
                    'comparison',
                    // 'Compra' => 
                    'purchase',
                    // 'Ingreso a Almacén' => 
                    'inputs'
                ],
            ],
            'distribution' => [
                'title' => 'Distribución',
                'icon' => '<i class="fa fa-tasks"></i>',
                'modules' => [
                    // 'Salidas' => '/outputs',
                    'outputs',
                    // 'Distribuciones' => '/outputs1',
                    // 'Venta/Uso Final' => '/outputs2',
                ]
            ],
            'reports' => [
                'title' => 'Reportes',
                'icon' => '<i class="fa fa-info"></i>',
                'modules' => [
                    // 'Stock Actual' => '/stock-location',
                    // 'Stock y Configuracion de Productos' => '/stock-location-po',
                    // 'Inventario' => '/inventory',
                    // 'Inventario General' => '/inventory-general',
                    // 'Estado del Stock' => '/stock-status',
                    'inventory',
                    'inventory-general',
                    'stock-status',
                ]
            ],
            'directory' => [
                'title' => 'Contactos',
                'icon' => '<i class="fa fa-book"></i>',
                'modules' => [
                    // 'Proveedores' => '/suppliers'
                    'suppliers',
                ]
            ],
        // ],
    ],
    'permissions' => [
        // 1 => 'access',
        2 => 'LEER/ACCEDER', // leer
        3 => 'CREAR', // crear
        4 => 'EDITAR', // actualizar/modificar
        5 => 'ELIMINAR', // borrar
    ],
    'per_page' => 8,
    'name' => 'logistic',
    
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
