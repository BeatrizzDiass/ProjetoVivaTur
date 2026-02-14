<?php

namespace backend\models;

use Yii;
use common\models\User; // Altere de frontend\models\User para common\models\User

/**
 * This is the model class for table "comentarios".
 *
 * @property int $id
 * @property string $descricao
 * @property string $dataCriacao
 * @property int $experiencia_id
 * @property int $user_id
 * @property string|null $resposta
 * @property string|null $dataResposta
 *
 * @property Experiencias $experiencia
 * @property Turistas $turista
 * @property User $user
 */
class Comentarios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comentarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descricao', 'experiencia_id', 'user_id', 'turista_id'], 'required'],
            [['experiencia_id', 'user_id', 'turista_id'], 'integer'],
            [['dataCriacao', 'dataResposta'], 'safe'],
            [['descricao', 'resposta'], 'string', 'max' => 500],
            [['resposta, dataResposta'], 'default', 'value' => null],
            [['experiencia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Experiencias::class, 'targetAttribute' => ['experiencia_id' => 'id']],
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
            'descricao' => 'Comentário',
            'dataCriacao' => 'Data de Criação',
            'experiencia_id' => 'Experiência',
            'user_id' => 'Utilizador',
            'resposta' => 'Resposta',
            'dataResposta' => 'Data da Resposta',
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
     * Verifica se o comentário tem resposta do gestor
     *
     * @return bool
     */
    public function temResposta()
    {
        return !empty($this->resposta);
    }
}