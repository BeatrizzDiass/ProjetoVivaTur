<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "favoritos".
 *
 * @property int $id
 * @property int $experiencia_id
 * @property int $turista_id
 * @property int|null $user_id
 *
 * @property Experiencias $experiencia
 * @property Turistas $turista
 * @property User $user
 */
class Favoritos extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favoritos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['experiencia_id', 'turista_id'], 'required'],
            [['experiencia_id', 'turista_id', 'user_id'], 'integer'],
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
            'experiencia_id' => 'Experiencia ID',
            'turista_id' => 'Turista ID',
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
     * afterSave: publica notificação MQTT quando um favorito é criado/atualizado
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        try {
            $acao = $insert ? 'insert' : 'update';
            $topic = Yii::$app->params['mqtt']['topics']['favoritos'][$acao] ?? "vivaTur/favoritos/{$acao}";

            Yii::$app->mqtt->publishJson($topic, [
                'id' => $this->id,
                'experiencia_id' => $this->experiencia_id,
                'turista_id' => $this->turista_id,
                'user_id' => $this->user_id,
                'action' => $acao,
                'timestamp' => date('Y-m-d H:i:s'),
            ]);
        } catch (\Exception $e) {
            Yii::error("MQTT publish falhou (Favoritos/{$acao}): " . $e->getMessage(), __METHOD__);
        }
    }

    /**
     * afterDelete: publica notificação MQTT quando um favorito é apagado
     */
    public function afterDelete()
    {
        parent::afterDelete();

        try {
            $topic = Yii::$app->params['mqtt']['topics']['favoritos']['delete'] ?? 'vivaTur/favoritos/delete';

            Yii::$app->mqtt->publishJson($topic, [
                'id' => $this->id,
                'experiencia_id' => $this->experiencia_id,
                'turista_id' => $this->turista_id,
                'user_id' => $this->user_id,
                'action' => 'delete',
                'timestamp' => date('Y-m-d H:i:s'),
            ]);
        } catch (\Exception $e) {
            Yii::error("MQTT publish falhou (Favoritos/delete): " . $e->getMessage(), __METHOD__);
        }
    }

}
