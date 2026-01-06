<?php

namespace console\controllers;

use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;

class MqttController extends Controller
{
    /**
     * Publica uma mensagem num tópico.
     *
     * Exemplo:
     *  php yii mqtt/publish "vivaTur/teste" "ola" 0 0
     */
    public function actionPublish(string $topic, string $message, int $qos = 0, int $retain = 0): int
    {
        \Yii::$app->mqtt->publish($topic, $message, $qos, (bool)$retain);
        $this->stdout("OK: publicado em {$topic}\n", Console::FG_GREEN);
        return ExitCode::OK;
    }

    /**
     * Subscrição “blocking” (Ctrl+C para parar).
     *
     * Exemplo:
     *  php yii mqtt/subscribe "vivaTur/#"
     */
    public function actionSubscribe(string $topic = 'vivaTur/#', int $qos = 0): int
    {
        $this->stdout("A subscrever {$topic} ... (Ctrl+C para parar)\n", Console::FG_CYAN);

        \Yii::$app->mqtt->subscribe($topic, function (string $topic, string $message, bool $retained) {
            $meta = $retained ? ' retained' : '';
            $this->stdout("[" . date('c') . "] {$topic}{$meta}\n", Console::FG_YELLOW);
            $this->stdout($message . "\n");
            $this->stdout(str_repeat('-', 60) . "\n", Console::FG_GREY);
        }, $qos);

        return ExitCode::OK;
    }
}


