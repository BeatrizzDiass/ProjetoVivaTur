<?php

namespace frontend\models;

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
 * @property int $turista_id
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
            // Campos obrigatórios ao criar comentário
            [['descricao', 'experiencia_id', 'turista_id'], 'required'],

            // Campos numéricos
            [['experiencia_id', 'turista_id'], 'integer'],

            // Campos de data
            [['dataCriacao', 'dataResposta'], 'safe'],

            // Campos de texto - NOTE: removido 'max' => 45 porque comentários precisam ser maiores
            [['descricao'], 'string', 'max' => 500], // Aumentei para 500 caracteres

            // Resposta é opcional (só preenchida pelo gestor)
            [['resposta'], 'string', 'max' => 500],
            [['resposta'], 'default', 'value' => null],
            [['dataResposta'], 'default', 'value' => null],

            // Validações de relacionamento
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
            'descricao' => 'Comentário',
            'dataCriacao' => 'Data de Criação',
            'experiencia_id' => 'Experiência',
            // 'user_id' => 'Utilizador',
            'turista_id' => 'Turista',
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
     * Gets query for [[Turista]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTurista()
    {
        return $this->hasOne(Turistas::class, ['id' => 'turista_id']);
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