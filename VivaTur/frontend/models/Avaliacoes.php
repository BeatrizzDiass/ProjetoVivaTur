<?php

namespace frontend\models;

use Yii;

use frontend\models\User;


/**
 * This is the model class for table "avaliacoes".
 *
 * @property int $id
 * @property string $estrela
 * @property int $experiencia_id
 *
 * @property Experiencias $experiencia
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
            [['estrela', 'experiencia_id', 'user_id'], 'required'],
            [['experiencia_id', 'user_id'], 'integer'],
            [['estrela'], 'string', 'max' => 45],

            [['experiencia_id'], 'exist',
                'skipOnError' => true,
                'targetClass' => Experiencias::class,
                'targetAttribute' => ['experiencia_id' => 'id']
            ],

            [['user_id'], 'exist',
                'skipOnError' => true,
                'targetClass' => User::class,
                'targetAttribute' => ['user_id' => 'id']
            ],
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
        return $this->hasOne(Experiencias::class, ['id' => 'experiencia_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }


}
