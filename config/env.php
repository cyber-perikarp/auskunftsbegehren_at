<?php
use codemix\yii2confload\Config;

Config::initEnv(__DIR__ . '/..');

return [
    "DB_DSN" => Config::env("DB_DSN"),
    "DB_USERNAME" => Config::env("DB_USERNAME"),
    "DB_PASSWORD" => Config::env("DB_PASSWORD"),
    "EMAIL_FROM" => Config::env("EMAIL_FROM"),
	"EMAIL_USERNAME" => Config::env("EMAIL_USERNAME"),
	"EMAIL_PASSWORD" => Config::env("EMAIL_PASSWORD"),
	"EMAIL_SERVER" => Config::env("EMAIL_SERVER"),
    "SALT" => Config::env("SALT"),
	"HOST" => Config::env("HOST"),
];