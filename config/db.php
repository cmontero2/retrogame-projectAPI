<?php
//se configura la conexión a la BD
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=retrogame',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
