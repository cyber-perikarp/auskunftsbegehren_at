<?php

return [
	"baseDir" => __DIR__ . '/..',
    'adminEmail' => $env["EMAIL_FROM"],
    "salt" => $env["SALT"],
    "frist" => 8, // Wochen
	"outputBaseDir" => "/var/pdfStorage",
	"host" => $env["HOST"],
	"email_from" => $env["EMAIL_FROM"],
	"email_server" => $env["EMAIL_SERVER"],
	"email_username" => $env["EMAIL_USERNAME"],
	"email_password" => $env["EMAIL_PASSWORD"]
];
