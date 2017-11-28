<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => $env["db_dsn"],
    'username' => $env["db_username"],
    'password' => $env["db_password"],
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
