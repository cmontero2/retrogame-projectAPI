<?php

return  [
    ['class' => 'yii\rest\UrlRule',
        'pluralize'=>false,
        'controller' => ['entradas', 'categorias', 'comentarios', 'juegos', 'juegos-categoria', 'nivel-foro', 'roles', 'secciones', 'usuarios-juego'],
    ],
    //permite hacer el login y responde devolviendo un token
    ['class' => 'yii\rest\UrlRule',
    'controller' => ['users'],
    'pluralize'=>false,
    'extraPatterns'=>['POST authenticate'=>'authenticate',
            'OPTIONS authenticate'=>'authenticate',
        ],
    ],
    //accion para enviar correo
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => ['contact'],
        'pluralize'=>false,
        'extraPatterns'=>[
            'POST send'=>'send',
            'OPTIONS send'=>'send',
        ],
    ],

    /* Intento de upload en backend */
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => ['users'],
        'pluralize'=> false,
        'extraPatterns'=>['POST upload'=>'upload',
            'OPTIONS upload'=>'upload',
        ],
    ]
];

?>