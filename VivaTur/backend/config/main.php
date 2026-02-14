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

                //Categorias
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/categoria'],
                    'pluralize' => true,
                    'extraPatterns' => [
                        //Pesquisar por nome da categoria
                        'GET nome/<nomecategoria>' => 'pesquisarpornome', //actionPesquisarpornome
                    ],
                ],

                //Linguas
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/lingua'],
                    'pluralize' => true,
                    'extraPatterns' => [
                        // Pesquisar por nome da lingua
                        'GET nome/<nomelingua>' => 'pesquisarpornome', //actionPesquisarpornome
                    ],
                ],

                //Experiências
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/experiencia'],
                    'pluralize' => true,
                    'extraPatterns' => [
                        //Filtrar por categoria, país e nome
                        'GET filtradas' => 'getexperienciasfiltradas', //actionGetexperienciasfiltradas
                    ],
                ],

                //Paises
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/paises'],
                    'pluralize' => false,
                    'extraPatterns' => [
                        // Pesquisar por nome do país
                        'GET nome/<nomepais>' => 'pesquisarpornome', //actionPesquisarpornome
                    ],
                ],

                //Avaliações
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/avaliacoes'],
                    'pluralize' => false,
                    'extraPatterns' => [
                        //criar, editar e eliminar avaliações
                        'POST' => 'postavaliacoes',
                        'PUT <id:\d+>' => 'putavaliacoes',
                        'DELETE <id:\d+>' => 'delete',
                        //avaliações por utilizador
                        'GET user/<user_id:\d+>' => 'getavaliacoesuser',
                        //avaliações por experiência
                        'GET experiencias/<experiencia_id:\d+>/avaliacoes' => 'getavaliacoesexperiencia',
                        'POST experiencias/<experiencia_id:\d+>/avaliacoes' => 'postavaliacoesexperiencia',
                        'PUT experiencias/<experiencia_id:\d+>/avaliacoes/<id:\d+>' => 'putavaliacoesexperiencia',
                        'DELETE experiencias/<experiencia_id:\d+>/avaliacoes/<id:\d+>' => 'deleteavaliacoesexperiencia',
                    ],
                ],

                //Comentários
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/comentario'],
                    'pluralize' => true,
                    'extraPatterns' => [
                        //criar, editar e eliminar comentários
                        'POST' => 'postcomentarios',
                        'PUT <id:\d+>' => 'putcomentario',
                        'DELETE <id:\d+>' => 'delete',
                        //comentários por experiência
                        'GET experiencia/<experiencia_id:\d+>' => 'getcomentariosexperiencia',
                        'POST experiencia/<experiencia_id:\d+>' => 'postcomentariosexperiencia',
                        'PUT experiencia/<experiencia_id:\d+>/<id:\d+>' => 'putcomentariosexperiencia',
                        'DELETE experiencia/<experiencia_id:\d+>/<id:\d+>' => 'deletecomentariosexperiencia',
                        //comentários por utilizador
                        'GET user/<user_id:\d+>' => 'getcomentariosuser',

                    ],
                ],

                //Favoritos
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/favorito'],
                    'pluralize' => true,
                    'extraPatterns' => [
                        //criar e eliminar favoritos
                        'POST' => 'postfavorito',  //actionPostfavorito
                        'DELETE <id:\d+>' => 'delete', //actionDelete
                    ],
                ],

                //Métodos de pagamento
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/metodopagamento'],
                    'pluralize' => true,
                    'extraPatterns' => [
                        // Pesquisar por nome do método de pagamento
                        'GET nome/<metodopagamento>' => 'pesquisarpornome', //actionPesquisarpornome
                    ],
                ],

                //Turistas
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/turista'],
                    'pluralize' => true,
                    'extraPatterns' => [],
                ],

                //Reservas
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/reserva'],
                    'pluralize' => false,
                    'extraPatterns' => [
                        //criar e eliminar reservas
                        'GET experiencia/<id:\d+>' => 'experiencia',
                        'POST' => 'postreserva',
                        'DELETE <id:\d+>' => 'delete',
                        //reservas por utilizador
                        'GET user/<user_id:\d+>' => 'getreservasuser',
                    ],
                ],

                //Gestores
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/gestor'],
                    'pluralize' => false,
                    'extraPatterns' => [
                        //gestores
                        'GET gestorbyuser/<user_id:\d+>' => 'gestorbyuser',
                    ],
                ],
                //Users
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/users'],
                    'pluralize' => false,
                    'extraPatterns' => [
                        //obter e atualizar dados do utilizador autenticado
                        'GET me' => 'me', //actionMe
                        'PUT me' => 'putme', //actionPutMe
                    ],
                ],

                //Autenticação
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/auth'],
                    'pluralize' => false,
                    'extraPatterns' => [
                        //login, registo e recuperação de password
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