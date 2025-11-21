<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "favorito".
 *
 * @property int $id
 * @property int $experiencia_id
 * @property int $user_id
 *
 * @property Experiencia $experiencia // Assumindo que o modelo Experiencia está em common/models
 * @property \common\models\User $user
 */
class Favorito extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favorito';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['experiencia_id', 'user_id'], 'required'],
            [['experiencia_id', 'user_id'], 'integer'],
            [['experiencia_id'], 'exist', 'skipOnError' => true, 'targetClass' => '\common\models\Experiencia', 'targetAttribute' => ['experiencia_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => '\common\models\User', 'targetAttribute' => ['user_id' => 'id']],
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
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[Experiencia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExperiencia()
    {
        return $this->hasOne(\common\models\Experiencia::class, ['id' => 'experiencia_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\common\models\User::class, ['id' => 'user_id']);
    }

}
