<?php

namespace common\models;

use Yii;

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
            [['resposta', 'dataResposta'], 'default', 'value' => null],
            [['descricao', 'dataCriacao', 'experiencia_id', 'user_id', 'turista_id'], 'required'],
            [['experiencia_id', 'user_id', 'turista_id'], 'integer'],
            [['dataResposta'], 'safe'],
            [['descricao', 'dataCriacao', 'resposta'], 'string', 'max' => 45],
            [['experiencia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Experiencias::class, 'targetAttribute' => ['experiencia_id' => 'id']],
            [['turista_id'], 'exist', 'skipOnError' => true, 'targetClass' => Turistas::class, 'targetAttribute' => ['turista_id' => 'id']],
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
            'turista_id' => 'Turista ID',
            'resposta' => 'Resposta',
            'dataResposta' => 'Data Resposta',
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
     * afterSave: publica notificação MQTT quando um comentário é criado/atualizado
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if ($insert) {
            try {
                $mqtt = Yii::$app->mqtt;
                if ($mqtt !== null) {
                    $mqtt->publishJson('comentarios/novo', [
                        'id' => $this->id,
                        'descricao' => $this->descricao,
                        'experiencia_id' => $this->experiencia_id,
                        'user_id' => $this->user_id,
                        'dataCriacao' => $this->dataCriacao,
                    ]);
                }
            } catch (\Exception $e) {
                // Log do erro mas não bloqueia a criação
                \Yii::error("MQTT Error: " . $e->getMessage(), 'mqtt');
            }
        }
    }

    /**
     * afterDelete: publica notificação MQTT quando um comentário é apagado
     */
    public function afterDelete()
    {
        parent::afterDelete();

        try {
            $topic = Yii::$app->params['mqtt']['topics']['comentarios']['delete'] ?? 'vivaTur/comentarios/delete';

            Yii::$app->mqtt->publishJson($topic, [
                'id' => $this->id,
                'experiencia_id' => $this->experiencia_id,
                'user_id' => $this->user_id,
                'action' => 'delete',
                'timestamp' => date('Y-m-d H:i:s'),
            ]);
        } catch (\Exception $e) {
            Yii::error("MQTT publish falhou (Comentarios/delete): " . $e->getMessage(), __METHOD__);
        }
    }

}
