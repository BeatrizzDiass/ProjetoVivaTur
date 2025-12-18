<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'api' => [
            'class' => 'backend\modules\api\ModuleAPI',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],

        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],

        'session' => [
            'name' => 'advanced-backend',
        ],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [

                //Regras de URL para a API RESTful

                // Regras para o controlador de Categoria
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/categoria'],
                    'pluralize' => true,
                    'extraPatterns' => [
                        // Regras personalizadas para pesquisar por nome da categoria
                        'GET nome/<nomecategoria>' => 'pesquisarpornome', //actionPesquisarpornome
                    ],
                ],

                // Regras para o controlador de Lingua
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/lingua'],
                    'pluralize' => true,
                    'extraPatterns' => [
                        // Regras personalizadas para pesquisar por nome da lingua
                        'GET nome/<nomelingua>' => 'pesquisarpornome', //actionPesquisarpornome
                    ],
                ],

                // Regras para o controlador de Experiencia
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/experiencia'],
                    'pluralize' => true,
                    'extraPatterns' => [
                        // Regras personalizadas para experiências filtradas por categoria, país e nome
                        'GET filtradas' => 'getexperienciasfiltradas', //actionGetexperienciasfiltradas
                    ],
                ],

                // Regras para o controlador de Pais
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/paises'],
                    'pluralize' => false,
                    'extraPatterns' => [
                        // Regras personalizadas para pesquisar por nome do país
                        'GET nome/<nomepais>' => 'pesquisarpornome', //actionPesquisarpornome
                    ],
                ],

                // Regras para o controlador de Avaliacoes
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/avaliacoes'],
                    'pluralize' => false,
                    'extraPatterns' => [
                        // Regras personalizadas para operações de avaliações de experiências (em geral)
                        'POST' => 'postavaliacoes', //actionPostavaliacoes
                        'PUT <id:\d+>' => 'putavaliacoes', //actionPutavaliacoes
                        'DELETE <id:\d+>' => 'delete',  //actionDelete

                        // Regras personalizadas para operações de avaliações de experiências específicas
                        'GET experiencias/<experiencia_id:\d+>/avaliacoes' => 'getavaliacoesexperiencia', //actionGetavaliacoesexperiencia
                        'POST experiencias/<experiencia_id:\d+>/avaliacoes' => 'postavaliacoesexperiencia', //actionPostavaliacoesexperiencia
                        'PUT experiencias/<experiencia_id:\d+>/avaliacoes/<id:\d+>' => 'putavaliacoesexperiencia', //actionPutavaliacoesexperiencia
                        'DELETE experiencias/<experiencia_id:\d+>/avaliacoes/<id:\d+>' => 'deleteavaliacoesexperiencia', //actionDeleteavaliacoesexperiencia
                    ],
                ],

                // Regras para o controlador de Comentario
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/comentario'],
                    'pluralize' => true,
                    'extraPatterns' => [
                        // Regras personalizadas para operações de comentários (em geral)
                        'POST postcomentarios' => 'postcomentarios', //actionPostcomentarios
                        'PUT <id:\d+>' => 'putcomentario', //actionPutcomentario
                        'DELETE <id:\d+>' => 'delete', //actionDelete

                        // Regras personalizadas para operações de comentários de experiências específicas
                        'GET experiencias/<experiencia_id:\d+>/comentarios' => 'getcomentariosexperiencia', //actionGetcomentariosexperiencia
                        'POST experiencias/<experiencia_id:\d+>/comentarios' => 'postcomentariosexperiencia', //actionPostcomentariosexperiencia
                        'PUT experiencias/<experiencia_id:\d+>/comentarios/<id:\d+>' => 'putcomentariosexperiencia',    //actionPutcomentariosexperiencia
                        'DELETE experiencias/<experiencia_id:\d+>/comentarios/<id:\d+>' => 'deletecomentariosexperiencia', //actionDeletecomentariosexperiencia
                    ],
                ],


                // Regras para o controlador de Favorito
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/favorito'],
                    'pluralize' => true,
                    'extraPatterns' => [
                        // Regras personalizadas para operações de favoritos
                        'POST' => 'postfavorito',  //actionPostfavorito
                        'DELETE <id:\d+>' => 'delete', //actionDelete
                    ],
                ],

                // Regras para o controlador de MetodoPagamento
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/metodopagamento'],
                    'pluralize' => true,
                    'extraPatterns' => [
                        // Regras personalizadas para pesquisar por nome do método de pagamento
                        'GET nome/<metodopagamento>' => 'pesquisarpornome', //actionPesquisarpornome
                    ],
                ],

                // Regras para o controlador de Reserva
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/reserva'],
                    'pluralize' => true,
                    'extraPatterns' => [
                        // Regras personalizadas para operações de reservas
                        'POST' => 'postreserva',  //actionPostreserva
                        'DELETE <id:\d+>' => 'delete', //actionDelete
                    ],
                ],

                // Regras para o controlador de Users
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/users'],
                    'pluralize' => false,
                    'extraPatterns' => [
                        // Regras personalizadas para operações relacionadas ao usuário autenticado
                        'GET me' => 'me', //actionMe
                        'PUT me' => 'putme', //actionPutMe
                    ],
                ],

                // Regras para o controlador de AuthController
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/auth'],
                    'pluralize' => false,
                    'extraPatterns' => [
                        'POST login' => 'login',
                        'POST register' => 'register',
                        'POST recover' => 'recover',
                    ],
                ],

            ],
        ],
    ],
    'params' => $params,
];