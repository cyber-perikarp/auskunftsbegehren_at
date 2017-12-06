<?php
use codemix\yii2confload\Config;

Config::initEnv(__DIR__ . '/..');

return [
    "DB_DSN" => Config::env("DB_DSN"),
    "DB_USERNAME" => Config::env("DB_USERNAME"),
    "DB_PASSWORD" => Config::env("DB_PASSWORD"),
    "EMAIL_FROM" => Config::env("EMAIL_FROM"),
    "SALT" => Config::env("SALT")
];