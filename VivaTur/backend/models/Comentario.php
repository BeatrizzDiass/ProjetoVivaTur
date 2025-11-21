<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comentario".
 *
 * @property int $id
 * @property string $descricao
 * @property string $dataCriacao
 * @property int $experiencia_id
 * @property int $user_id
 *
 * @property Experiencia $experiencia
 * @property User $user
 */
class Comentario extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comentario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descricao', 'dataCriacao', 'experiencia_id', 'user_id'], 'required'],
            [['experiencia_id', 'user_id'], 'integer'],
            [['descricao', 'dataCriacao'], 'string', 'max' => 45],
            [['experiencia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Experiencia::class, 'targetAttribute' => ['experiencia_id' => 'id']],
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
            'descricao' => 'Descricao',
            'dataCriacao' => 'Data Criacao',
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
        return $this->hasOne(Experiencia::class, ['id' => 'experiencia_id']);
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
