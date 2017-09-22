<?php
return [
    /**
        En desuso
    */
    'permissions' => [
        // 1 => 'access',
        2 => 'LEER/ACCEDER', // leer
        3 => 'CREAR', // crear
        4 => 'EDITAR', // actualizar/modificar
        5 => 'ELIMINAR', // borrar
    ],
    'name' => 'logistic',

    // STATIC
    // ===========================================================
    'modules' => [
        'products' => [
            'title' => 'Registro de Productos',
            'description' => 'Modulo para registrar los productos',
            'categorie' => 'products'
        ],
        'users' => [
            'title' => 'Usuarios',
            'description' => 'Modulo para gestionar los usuarios',
            'categorie' => 'utilities'
        ],
        'permissions' => [
            'title' => 'Permisos',
            'description' => 'Modulo para configurar los usuarios y sus permisos',
            'categorie' => 'utilities'
        ],
        'config' => [
            'title' => 'Configuracion',
            'description' => 'Configuraciones de la aplicacion',
            'categorie' => 'utilities',
        ],
        'products-config' => [
            'title' => 'Configuracion de Productos',
            'description' => 'Configuraciones de los productos, individual por cada Area',
            'categorie' => 'products',
        ],
        'requeriments' => [
            'title' => 'Requerimientos',
            'description' => 'Modulo para realizar un requerimiento, para solicitar productos que requiere un Area o para realizar un proceso de cotizacion segun el Area',
            'categorie' => 'purchase',
        ],
        'quotations' => [
            'title' => 'Cotizaciones',
            'description' => 'Modulo para realizar cotizaciones, la siguiente fase del proceso de compra por requerimientos',
            'categorie' => 'purchase',
        ],
        'comparison' => [
            'title' => 'Comparaciones',
            'description' => 'Modulo para realizar comparaciones, permite relizar comparaciones entre los precios de diferentes proveedores registrados en la cotizaciòn',
            'categorie' => 'purchase',
        ],
        'purchase' => [
            'title' => 'Compra',
            'description' => 'Modulo para generar ordenes de compra segun los productos de los proveedores seleccionados en la comparaciòn',
            'categorie' => 'purchase',
        ],
        'inputs' => [
            'title' => 'Entradas a Almacén',
            'description' => 'Modulo para registrar productos que ingresan al almacén',
            'categorie' => 'purchase',
        ],
        'outputs' => [
            'title' => 'Salidas del Almacén',
            'description' => 'Modulo para registrar productos que salen del almacén',
            'categorie' => 'distribution',
        ],
        'inventory' => [
            'title' => 'Inventario',
            'description' => 'Modulo para registrar productos que salen del almacén',
            'categorie' => 'reports',
        ],
        'inventory-general' => [
            'title' => 'Inventario General',
            'description' => 'Modulo para registrar productos que salen del almacén',
            'categorie' => 'reports',
        ],
        'stock-status' => [
            'title' => 'Stock',
            'description' => 'Modulo para registrar productos que salen del almacén',
            'categorie' => 'reports',
        ],
        'suppliers' => [
            'title' => 'Proveedores',
            'description' => 'Modulo para registrar productos que salen del almacén',
            'categorie' => 'directory',
        ],
    ],
    'menu' => [
        'categories' => [
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
                    'quotations',
                    'comparison',
                    'purchase',
                    'inputs'
                ],
            ],
            'distribution' => [
                'title' => 'Distribución',
                'icon' => '<i class="fa fa-tasks"></i>',
                'modules' => [
                    'outputs',
                ]
            ],
            'reports' => [
                'title' => 'Reportes',
                'icon' => '<i class="fa fa-info"></i>',
                'modules' => [
                    'inventory',
                    'inventory-general',
                    'stock-status',
                ]
            ],
            'directory' => [
                'title' => 'Contactos',
                'icon' => '<i class="fa fa-book"></i>',
                'modules' => [
                    'suppliers',
                ]
            ],
        ],
    ],
    'per_page' => 8,
    'location' => [
        'default_id' => 1,
        'type' => [
            1 => 'ALMACEN',
            2 => 'SUCURSAL',
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
    ],
];
