<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reservas".
 *
 * @property int $id
 * @property string|null $dataReserva
 * @property string|null $disponivel
 * @property int|null $numPessoas
 * @property int $experiencia_id
 * @property int $user_id
 * @property int $metodoPagamento_id
 * @property int|null $turista_id
 *
 * @property Experiencias $experiencia
 * @property Metodopagamentos $metodoPagamento
 * @property Turistas $turista
 * @property User $user
 */
class Reservas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reservas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dataReserva', 'disponivel', 'numPessoas', 'turista_id'], 'default', 'value' => null],
            [['numPessoas', 'experiencia_id', 'user_id', 'metodoPagamento_id', 'turista_id'], 'integer'],
            [['experiencia_id', 'user_id', 'metodoPagamento_id'], 'required'],
            [['dataReserva', 'disponivel'], 'string', 'max' => 45],
            [['experiencia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Experiencias::class, 'targetAttribute' => ['experiencia_id' => 'id']],
            [['metodoPagamento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Metodopagamentos::class, 'targetAttribute' => ['metodoPagamento_id' => 'id']],
            [['turista_id'], 'exist', 'skipOnError' => true, 'targetClass' => Turistas::class, 'targetAttribute' => ['turista_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dataReserva' => 'Data Reserva',
            'disponivel' => 'Disponivel',
            'numPessoas' => 'Num Pessoas',
            'experiencia_id' => 'Experiencia ID',
            'user_id' => 'User ID',
            'metodoPagamento_id' => 'Metodo Pagamento ID',
            'turista_id' => 'Turista ID',
        ];
    }

    /**
     * Gets query for [[Experiencia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExperiencia()
    {
        return $this->hasOne(Experiencias::class, ['id' => 'experiencia_id']);
    }

    /**
     * Gets query for [[MetodoPagamento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMetodoPagamento()
    {
        return $this->hasOne(Metodopagamentos::class, ['id' => 'metodoPagamento_id']);
    }

    /**
     * Gets query for [[Turista]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTurista()
    {
        return $this->hasOne(Turistas::class, ['id' => 'turista_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * afterSave: publica notificação MQTT quando uma reserva é criada/atualizada
     * Versão segura - não quebra se MQTT não estiver disponível
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        // Verifica se o componente MQTT está configurado
        if (!isset(Yii::$app->mqtt)) {
            Yii::info("MQTT component não configurado - notificação não enviada", __METHOD__);
            return;
        }

        try {
            $acao = $insert ? 'insert' : 'update';
            $topic = Yii::$app->params['mqtt']['topics']['reservas'][$acao] ?? "vivaTur/reservas/{$acao}";

            Yii::$app->mqtt->publishJson($topic, [
                'id' => $this->id,
                'dataReserva' => $this->dataReserva,
                'numPessoas' => $this->numPessoas,
                'disponivel' => $this->disponivel,
                'experiencia_id' => $this->experiencia_id,
                'turista_id' => $this->turista_id,
                'metodoPagamento_id' => $this->metodoPagamento_id,
                'action' => $acao,
                'timestamp' => date('Y-m-d H:i:s'),
            ]);
        } catch (\Throwable $e) {
            // Log o erro mas não impede a operação de salvar
            Yii::error("MQTT publish falhou (Reservas/{$acao}): " . $e->getMessage(), __METHOD__);
            // A reserva foi salva com sucesso mesmo se MQTT falhar
        }
    }

    /**
     * afterDelete: publica notificação MQTT quando uma reserva é apagada
     * Versão segura - não quebra se MQTT não estiver disponível
     */
    public function afterDelete()
    {
        parent::afterDelete();

        // Verifica se o componente MQTT está configurado
        if (!isset(Yii::$app->mqtt)) {
            Yii::info("MQTT component não configurado - notificação não enviada", __METHOD__);
            return;
        }

        try {
            $topic = Yii::$app->params['mqtt']['topics']['reservas']['delete'] ?? 'vivaTur/reservas/delete';

            Yii::$app->mqtt->publishJson($topic, [
                'id' => $this->id,
                'experiencia_id' => $this->experiencia_id,
                'turista_id' => $this->turista_id,
                'action' => 'delete',
                'timestamp' => date('Y-m-d H:i:s'),
            ]);
        } catch (\Throwable $e) {
            // Log o erro mas não impede a operação de delete
            Yii::error("MQTT publish falhou (Reservas/delete): " . $e->getMessage(), __METHOD__);
            // A reserva foi apagada com sucesso mesmo se MQTT falhar
        }
    }
}