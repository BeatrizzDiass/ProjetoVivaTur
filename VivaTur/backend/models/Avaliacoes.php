<?php

namespace backend\models;

use backend\models\Turistas;
use Yii;
use common\models\User; // Changed from frontend\models\User

/**
 * This is the model class for table "avaliacoes".
 *
 * @property int $id
 * @property int $estrela
 * @property int $experiencia_id
 * @property int $user_id
 * @property int $turista_id
 *
 * @property Experiencias $experiencia
 * @property User $user
 * @property Turistas $turista
 */
class Avaliacoes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'avaliacoes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estrela', 'experiencia_id', 'turista_id', 'turista_id'], 'required'],
            [['estrela', 'experiencia_id', 'turista_id', 'turista_id'], 'integer'],
            [['estrela'], 'in', 'range' => [1, 2, 3, 4, 5]],
            [['experiencia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Experiencias::class, 'targetAttribute' => ['experiencia_id' => 'id']],
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
            'estrela' => 'Classificação',
            'experiencia_id' => 'Experiência',
            // 'user_id' => 'Utilizador',
            'turista_id' => 'Turista',
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
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
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
}