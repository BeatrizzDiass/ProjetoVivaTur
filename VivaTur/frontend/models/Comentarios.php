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
 * @property string|null $resposta
 * @property string|null $dataResposta
 *
 * @property Experiencias $experiencia
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
            // Campos obrigatórios ao criar comentário
            [['descricao', 'experiencia_id', 'user_id'], 'required'],

            // Campos numéricos
            [['experiencia_id', 'user_id'], 'integer'],

            // Campos de data
            [['dataCriacao', 'dataResposta'], 'safe'],

            // Campos de texto
            [['descricao'], 'string', 'max' => 500],

            // Resposta é opcional (só preenchida pelo gestor)
            [['resposta'], 'string', 'max' => 500],
            [['resposta'], 'default', 'value' => null],
            [['dataResposta'], 'default', 'value' => null],

            // Validações de relacionamento
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
     * Gets query for [[Turista]] através do user.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTurista()
    {
        return $this->hasOne(Turistas::class, ['user_id' => 'user_id']);
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