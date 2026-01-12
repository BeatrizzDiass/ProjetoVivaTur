<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "avaliacoes".
 *
 * @property int $id
 * @property string $estrela
 * @property int $experiencia_id
 * @property int $user_id
 * @property int $turista_id
 *
 * @property Experiencias $experiencia
 * @property Turistas $turista
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
            [['estrela', 'experiencia_id', 'user_id', 'turista_id'], 'required'],
            [['experiencia_id', 'user_id', 'turista_id'], 'integer'],
            [['estrela'], 'string', 'max' => 45],
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
            'estrela' => 'Estrela',
            'experiencia_id' => 'Experiencia ID',
            'user_id' => 'User ID',
            'turista_id' => 'Turista ID',
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
     * afterSave: publica notificação MQTT quando uma avaliação é criada/atualizada
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        try {
            $acao = $insert ? 'insert' : 'update';
            $topic = Yii::$app->params['mqtt']['topics']['avaliacoes'][$acao] ?? "vivaTur/avaliacoes/{$acao}";

            Yii::$app->mqtt->publishJson($topic, [
                'id' => $this->id,
                'estrela' => $this->estrela,
                'experiencia_id' => $this->experiencia_id,
                'turista_id' => $this->turista_id,
                'action' => $acao,
                'timestamp' => date('Y-m-d H:i:s'),
            ]);
        } catch (\Exception $e) {
            Yii::error("MQTT publish falhou (Avaliacoes/{$acao}): " . $e->getMessage(), __METHOD__);
        }
    }

    /**
     * afterDelete: publica notificação MQTT quando uma avaliação é apagada
     */
    public function afterDelete()
    {
        parent::afterDelete();

        try {
            $topic = Yii::$app->params['mqtt']['topics']['avaliacoes']['delete'] ?? 'vivaTur/avaliacoes/delete';

            Yii::$app->mqtt->publishJson($topic, [
                'id' => $this->id,
                'experiencia_id' => $this->experiencia_id,
                'turista_id' => $this->turista_id,
                'action' => 'delete',
                'timestamp' => date('Y-m-d H:i:s'),
            ]);
        } catch (\Exception $e) {
            Yii::error("MQTT publish falhou (Avaliacoes/delete): " . $e->getMessage(), __METHOD__);
        }
    }

}
