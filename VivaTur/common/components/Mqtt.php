<?php

namespace common\components;

use PhpMqtt\Client\ConnectionSettings;
use PhpMqtt\Client\MqttClient;
use yii\base\InvalidArgumentException;
use yii\base\Component;
use yii\base\InvalidConfigException;

class Mqtt extends Component
{
    /** @var string */
    public string $host = '127.0.0.1';

    /** @var int */
    public int $port = 1883;

    /** @var string|null */
    public ?string $username = null;

    /** @var string|null */
    public ?string $password = null;

    /** @var string */
    public string $clientIdPrefix = 'vivaTur-';

    /** @var int */
    public int $keepAlive = 60;

    /** @var int */
    public int $connectTimeout = 5;

    /** @var bool */
    public bool $useTls = false;

    /** @var bool */
    public bool $tlsSelfSignedAllowed = false;

    public function init(): void
    {
        parent::init();

        $cfg = \Yii::$app->params['mqtt'] ?? [];
        if (!is_array($cfg)) {
            throw new InvalidConfigException('params["mqtt"] tem de ser um array.');
        }

        $this->host = $cfg['host'] ?? $this->host;
        $this->port = (int)($cfg['port'] ?? $this->port);
        $this->username = $cfg['username'] ?? $this->username;
        $this->password = $cfg['password'] ?? $this->password;
        $this->clientIdPrefix = $cfg['clientIdPrefix'] ?? $this->clientIdPrefix;
        $this->keepAlive = (int)($cfg['keepAlive'] ?? $this->keepAlive);
        $this->connectTimeout = (int)($cfg['connectTimeout'] ?? $this->connectTimeout);
        $this->useTls = (bool)($cfg['useTls'] ?? $this->useTls);
        $this->tlsSelfSignedAllowed = (bool)($cfg['tlsSelfSignedAllowed'] ?? $this->tlsSelfSignedAllowed);
    }

    public function publish(string $topic, string $payload, int $qos = 0, bool $retain = false, ?string $clientId = null): void
    {
        $client = $this->createClient($clientId);
        $client->connect($this->buildConnectionSettings(), true);
        $client->publish($topic, $payload, $qos, $retain);
        $client->disconnect();
    }

    /**
     * Publica um payload JSON (útil para notificações).
     *
     * @param array|\JsonSerializable $payload
     */
    public function publishJson(string $topic, $payload, int $qos = 0, bool $retain = false, ?string $clientId = null): void
    {
        $json = json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        if ($json === false) {
            throw new InvalidArgumentException('Falha a serializar payload para JSON: ' . json_last_error_msg());
        }

        $this->publish($topic, $json, $qos, $retain, $clientId);
    }

    /**
     * Subscrição “blocking” (ideal para comandos de consola).
     *
     * @param callable(string $topic, string $message, bool $retained): void $handler
     */
    public function subscribe(string $topic, callable $handler, int $qos = 0, ?string $clientId = null): void
    {
        $client = $this->createClient($clientId);
        $client->connect($this->buildConnectionSettings(), true);

        $client->subscribe($topic, function (string $topic, string $message, bool $retained) use ($handler) {
            $handler($topic, $message, $retained);
        }, $qos);

        // Loop infinito até Ctrl+C
        $client->loop(true);
        $client->disconnect();
    }

    private function createClient(?string $clientId = null): MqttClient
    {
        $finalClientId = $clientId ?: ($this->clientIdPrefix . bin2hex(random_bytes(6)));
        return new MqttClient($this->host, $this->port, $finalClientId);
    }

    private function buildConnectionSettings(): ConnectionSettings
    {
        $settings = (new ConnectionSettings())
            ->setKeepAliveInterval($this->keepAlive)
            ->setConnectTimeout($this->connectTimeout)
            ->setUseTls($this->useTls)
            ->setTlsSelfSignedAllowed($this->tlsSelfSignedAllowed);

        if ($this->username !== null && $this->username !== '') {
            $settings = $settings->setUsername($this->username);
        }
        if ($this->password !== null && $this->password !== '') {
            $settings = $settings->setPassword($this->password);
        }

        return $settings;
    }
}


