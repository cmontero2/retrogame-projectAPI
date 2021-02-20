<?php

return  [
    ['class' => 'yii\rest\UrlRule',
        'pluralize'=>false,
        'controller' => ['entradas', 'categorias', 'comentarios', 'juegos', 'juegos-categoria', 'nivel-foro', 'roles', 'secciones', 'usuarios-juego'], //el nombre que quieras
    ],
    ['class' => 'yii\rest\UrlRule',
    'controller' => ['users'],
    'pluralize'=>false,
    'extraPatterns'=>['POST authenticate'=>'authenticate',
            'OPTIONS authenticate'=>'authenticate',
        ],
    ],

    [
        'class' => 'yii\rest\UrlRule',
        'controller' => ['contact'],
        'pluralize'=>false,
        'extraPatterns'=>[
            'POST send'=>'send',
            'OPTIONS send'=>'send',
        ],
    ],
];

?>