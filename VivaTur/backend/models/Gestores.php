<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "gestores".
 *
 * @property int $id
 * @property int $user_id
 *
 * @property Experiencias[] $experiencias
 * @property User $user
 */
class Gestores extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gestores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
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
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[Experiencias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExperiencias()
    {
        return $this->hasMany(Experiencias::class, ['gestor_id' => 'id']);
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
