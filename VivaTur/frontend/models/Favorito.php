<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "favoritos".
 *
 * @property int $id
 * @property int $experiencia_id
 * @property int $turista_id
 *
 * @property Experiencias $experiencia
 * @property Turistas $turista
 */
class Favorito extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favoritos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['experiencia_id', 'turista_id'], 'required'],
            [['experiencia_id', 'turista_id'], 'integer'],
            [['experiencia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Experiencias::class, 'targetAttribute' => ['experiencia_id' => 'id']],
            // Alterado para validar contra a tabela de Turistas
            [['turista_id'], 'exist', 'skipOnError' => true, 'targetClass' => Turistas::class, 'targetAttribute' => ['turista_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'experiencia_id' => 'Experiencia ID',
            'turista_id' => 'Turista ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExperiencia()
    {
        return $this->hasOne(Experiencias::class, ['id' => 'experiencia_id']);
    }

    /**
     * Nova relação para o Turista
     * @return \yii\db\ActiveQuery
     */
    public function getTurista()
    {
        return $this->hasOne(Turistas::class, ['id' => 'turista_id']);
    }
}