<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "avaliacao".
 *
 * @property int $id
 * @property string $estrela
 * @property int $experiencia_id
 *
 * @property Experiencia $experiencia
 */
class Avaliacao extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'avaliacao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estrela', 'experiencia_id'], 'required'],
            [['experiencia_id'], 'integer'],
            [['estrela'], 'string', 'max' => 45],
            [['experiencia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Experiencia::class, 'targetAttribute' => ['experiencia_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'estrela' => 'Estrela',
            'experiencia_id' => 'Experiencia ID',
        ];
    }

    /**
     * Gets query for [[Experiencia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExperiencia()
    {
        return $this->hasOne(Experiencia::class, ['id' => 'experiencia_id']);
    }

}
