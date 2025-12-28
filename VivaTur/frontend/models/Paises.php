<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "paises".
 *
 * @property int $id
 * @property string $nome
 *
 * @property Experiencias[] $experiencias
 */
class Paises extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'paises';
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
     * Gets query for [[Experiencias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExperiencias()
    {
        return $this->hasMany(Experiencias::class, ['pais_id' => 'id']);
    }

}
