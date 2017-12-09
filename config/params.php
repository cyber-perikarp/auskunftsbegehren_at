<?php

return [
    'adminEmail' => $env["EMAIL_FROM"],
    "salt" => $env["SALT"],
    "frist" => 8, // Wochen
	"pdf_template_file" => __DIR__ . '/../templates/dsg2000.txt'
];
