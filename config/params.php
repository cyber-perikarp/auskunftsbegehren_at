<?php

return [
	"baseDir" => __DIR__ . '/..',
    'adminEmail' => $env["EMAIL_FROM"],
    "salt" => $env["SALT"],
    "frist" => 8, // Wochen
	"outputBaseDir" => "/var/pdfStorage"
];
