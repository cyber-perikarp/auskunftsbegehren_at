<?php

return [
	'class' => 'yii\swiftmailer\Mailer',
	'transport' => [
		'class' => 'Swift_SmtpTransport',
		'host' => $env["EMAIL_SERVER"],
		'username' => $env["EMAIL_USERNAME"],
		'password' => $env["EMAIL_PASSWORD"],
		'port' => '587',
		'encryption' => 'tls',
	],
];