<?php

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/vendor/yiisoft/yii2/Yii.php';

require __DIR__ . '/common/config/bootstrap.php';
require __DIR__ . '/console/config/bootstrap.php';

use yii\helpers\ArrayHelper;
use common\models\Experiencias;

$config = ArrayHelper::merge(
    require __DIR__ . '/common/config/main.php',
    require __DIR__ . '/common/config/main-local.php',
    require __DIR__ . '/console/config/main.php',
    require __DIR__ . '/console/config/main-local.php'
);

new yii\console\Application($config);

$experiencia = new Experiencias([
    'nome' => 'Experiência MQTT ' . uniqid(),
    'descricao' => 'Experiência criada para testar notificações MQTT.',
    'horaInicio' => '10:00',
    'horaFim' => '12:00',
    'local' => 'Leiria',
    'dataDisponivel' => date('Y-m-d'),
    'precoPessoa' => '10',
    'imagem' => '',
    'numMaxParticipante' => '10',
    'numMinParticipante' => '1',
    'categoria_id' => 5,
    'gestor_id' => 4,
    'pais_id' => 2,
]);

// Corrigido: $exp -> $experiencia
if ($experiencia->save() && Yii::$app->has('mqtt')) {
    echo "Experiência criada com ID: {$experiencia->id}\n";

    Yii::$app->mqtt->publishJson(
        'vivaTur/experiencias',
        [
            'id' => $experiencia->id,
            'nome' => $experiencia->nome,
            'preco' => $experiencia->precoPessoa,
            'timestamp' => time(),
        ]
    );

    echo "Mensagem MQTT publicada com sucesso!\n";
} else {
    echo "Erro ao salvar experiência:\n";
    print_r($experiencia->errors);
}