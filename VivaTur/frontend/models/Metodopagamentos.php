<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "metodopagamentos".
 *
 * @property int $id
 * @property string $nome
 *
 * @property Reservas[] $reservas
 */
class Metodopagamentos extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'metodopagamentos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['nome'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
        ];
    }

    /**
     * Gets query for [[Reservas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReservas()
    {
        return $this->hasMany(Reservas::class, ['metodoPagamento_id' => 'id']);
    }

}
