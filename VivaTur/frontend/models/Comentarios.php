<?php

namespace frontend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "comentarios".
 *
 * @property int $id
 * @property string $descricao
 * @property string $dataCriacao
 * @property int $experiencia_id
 * @property int $user_id
 * @property int|null $turista_id
 * @property string|null $resposta
 * @property string|null $dataResposta
 *
 * @property Experiencias $experiencia
 * @property User $user
 * @property Turistas $turista
 */
class Comentarios extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'comentarios';
    }

    public function rules()
    {
        return [
            [['descricao', 'experiencia_id', 'user_id'], 'required'],
            [['experiencia_id', 'user_id', 'turista_id'], 'integer'],
            [['dataCriacao', 'dataResposta'], 'safe'],
            [['descricao', 'resposta'], 'string', 'max' => 500],
            [['resposta', 'dataResposta', 'turista_id'], 'default', 'value' => null],
            [['experiencia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Experiencias::class, 'targetAttribute' => ['experiencia_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['turista_id'], 'exist', 'skipOnError' => true, 'targetClass' => Turistas::class, 'targetAttribute' => ['turista_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao' => 'Comentário',
            'dataCriacao' => 'Data de Criação',
            'experiencia_id' => 'Experiência',
            'user_id' => 'Utilizador',
            'turista_id' => 'Turista',
            'resposta' => 'Resposta',
            'dataResposta' => 'Data da Resposta',
        ];
    }

    public function getExperiencia()
    {
        return $this->hasOne(Experiencias::class, ['id' => 'experiencia_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getTurista()
    {
        return $this->hasOne(Turistas::class, ['id' => 'turista_id']);
    }

    public function temResposta()
    {
        return !empty($this->resposta);
    }
}