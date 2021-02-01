<?php

return  [
    ['class' => 'yii\rest\UrlRule',
        'pluralize'=>false,
        'controller' => ['entrada'], //el nombre que quieras
    ],
    ['class' => 'yii\rest\UrlRule',
    'controller' => ['user'],
    'pluralize'=>false,
    'extraPatterns'=>['POST authenticate'=>'authenticate',
            'OPTIONS authenticate'=>'authenticate',
            ]
    ],
];

?>