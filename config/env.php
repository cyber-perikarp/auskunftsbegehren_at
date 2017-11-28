<?php
use codemix\yii2confload\Config;

Config::initEnv(__DIR__ . '/..');

return [
    "db_dsn" => Config::env("DB_DSN"),
    "db_username" => Config::env("DB_USERNAME"),
    "db_password" => Config::env("DB_PASSWORD"),
];