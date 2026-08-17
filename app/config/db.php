<?php

$dsn = getenv('DB_DSN') ?: 'mysql:host=127.0.0.1;port=3306;dbname=books_catalog';
$username = getenv('DB_USERNAME') ?: 'app';
$password = getenv('DB_PASSWORD') ?: 'app';

return [
    'class' => \yii\db\Connection::class,
    'dsn' => $dsn,
    'username' => $username,
    'password' => $password,
    'charset' => 'utf8mb4',
    'enableSchemaCache' => false,
];
