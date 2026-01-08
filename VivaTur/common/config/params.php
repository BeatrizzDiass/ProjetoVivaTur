<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'user.passwordResetTokenExpire' => 3600,
    'user.passwordMinLength' => 8,
    'mqtt' => [
        // Em Docker Compose, o host costuma ser "mosquitto". Em WAMP/local: "127.0.0.1".
        'host' => getenv('MQTT_HOST') ?: '127.0.0.1',
        'port' => (int) (getenv('MQTT_PORT') ?: 1883),
        // Opcional (se ativares auth no mosquitto.conf)
        'username' => null,
        'password' => null,
        'clientIdPrefix' => 'vivaTur-',
        'keepAlive' => 60,
        'connectTimeout' => 5,
        // TLS (opcional)
        'useTls' => false,
        'tlsSelfSignedAllowed' => false,
        // WebSockets (se precisares no browser)
        'wsPort' => (int) (getenv('MQTT_WS_PORT') ?: 9001),

        // Tópicos (alinha com a lógica de "notificações" dos slides)
        'topics' => [
            'experiencias' => [
                'insert' => 'vivaTur/experiencias/insert',
                'update' => 'vivaTur/experiencias/update',
                'delete' => 'vivaTur/experiencias/delete',
            ],
            'comentarios' => [
                'insert' => 'vivaTur/comentarios/insert',
                'update' => 'vivaTur/comentarios/update',
                'delete' => 'vivaTur/comentarios/delete',
            ],
            'favoritos' => [
                'insert' => 'vivaTur/favoritos/insert',
                'update' => 'vivaTur/favoritos/update',
                'delete' => 'vivaTur/favoritos/delete',
            ],
            'avaliacoes' => [
                'insert' => 'vivaTur/avaliacoes/insert',
                'update' => 'vivaTur/avaliacoes/update',
                'delete' => 'vivaTur/avaliacoes/delete',
            ],
            'reservas' => [
                'insert' => 'vivaTur/reservas/insert',
                'update' => 'vivaTur/reservas/update',
                'delete' => 'vivaTur/reservas/delete',
            ],
            'users' => [
                'insert' => 'vivaTur/users/insert',
                'update' => 'vivaTur/users/update',
                'delete' => 'vivaTur/users/delete',
            ],
            'linguas' => [
                'insert' => 'vivaTur/linguas/insert',
                'update' => 'vivaTur/linguas/update',
                'delete' => 'vivaTur/linguas/delete',
            ],
            'paises' => [
                'insert' => 'vivaTur/paises/insert',
                'update' => 'vivaTur/paises/update',
                'delete' => 'vivaTur/paises/delete',
            ],
        ],
    ],
];
