<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "reservas".
 *
 * @property int $id
 * @property string|null $dataReserva
 * @property int|null $disponivel
 * @property int $numPessoas
 * @property int $experiencia_id
 * @property int $turista_id
 * @property int $metodoPagamento_id
 *
 * @property Experiencias $experiencia
 * @property Turistas $turista
 * @property Metodopagamentos $metodoPagamento
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
            [['numPessoas', 'experiencia_id', 'turista_id', 'metodoPagamento_id', 'user_id'], 'required'],
            [['numPessoas', 'experiencia_id', 'turista_id', 'metodoPagamento_id', 'disponivel', 'user_id'], 'integer'],
            [['numPessoas'], 'integer', 'min' => 1],
            [['disponivel'], 'integer', 'min' => 0],
            [['dataReserva'], 'safe'],
            [['dataReserva'], 'date', 'format' => 'php:Y-m-d'],
            [['experiencia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Experiencias::class, 'targetAttribute' => ['experiencia_id' => 'id']],
            [['turista_id'], 'exist', 'skipOnError' => true, 'targetClass' => Turistas::class, 'targetAttribute' => ['turista_id' => 'id']],
            [['metodoPagamento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Metodopagamentos::class, 'targetAttribute' => ['metodoPagamento_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dataReserva' => 'Data da Reserva',
            'disponivel' => 'Lugares Disponíveis',
            'numPessoas' => 'Número de Pessoas',
            'experiencia_id' => 'Experiência',
            'turista_id' => 'Turista',
            'metodoPagamento_id' => 'Método de Pagamento',
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
     * Gets query for [[Turista]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTurista()
    {
        return $this->hasOne(Turistas::class, ['id' => 'turista_id']);
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

    public function getUser()
    {
        return $this->hasOne(\common\models\User::class, ['id' => 'user_id']);
    }

}