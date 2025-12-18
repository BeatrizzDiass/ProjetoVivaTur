<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reservas".
 *
 * @property int $id
 * @property string|null $dataReserva
 * @property string|null $disponivel
 * @property int $experiencia_id
 * @property int $user_id
 * @property int $metodoPagamento_id
 *
 * @property Experiencias $experiencia
 * @property Metodopagamentos $metodoPagamento
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
            [['dataReserva', 'disponivel'], 'default', 'value' => null],
            [['experiencia_id', 'user_id', 'metodoPagamento_id'], 'required'],
            [['experiencia_id', 'user_id', 'metodoPagamento_id'], 'integer'],
            [['dataReserva', 'disponivel'], 'string', 'max' => 45],
            [['experiencia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Experiencias::class, 'targetAttribute' => ['experiencia_id' => 'id']],
            [['metodoPagamento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Metodopagamentos::class, 'targetAttribute' => ['metodoPagamento_id' => 'id']],
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
            'experiencia_id' => 'Experiencia ID',
            'user_id' => 'User ID',
            'metodoPagamento_id' => 'Metodo Pagamento ID',
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
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

}
