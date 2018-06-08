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
        // 'streamOptions' => [
        // 	'ssl' => [
        // 		'allow_self_signed' => true,
        // 		'verify_peer' => false,
        // 		'verify_peer_name' => false,
        // 	],
        // ],
    ],
];
