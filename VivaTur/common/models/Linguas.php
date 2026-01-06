<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "linguas".
 *
 * @property int $id
 * @property string $nome
 */
class Linguas extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'linguas';
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
     * afterSave: publica notificação MQTT quando uma língua é criada/atualizada
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        try {
            $acao = $insert ? 'insert' : 'update';
            $topic = Yii::$app->params['mqtt']['topics']['linguas'][$acao] ?? "vivaTur/linguas/{$acao}";

            Yii::$app->mqtt->publishJson($topic, [
                'id' => $this->id,
                'nome' => $this->nome,
                'action' => $acao,
                'timestamp' => date('Y-m-d H:i:s'),
            ]);
        } catch (\Exception $e) {
            Yii::error("MQTT publish falhou (Linguas/{$acao}): " . $e->getMessage(), __METHOD__);
        }
    }

    /**
     * afterDelete: publica notificação MQTT quando uma língua é apagada
     */
    public function afterDelete()
    {
        parent::afterDelete();

        try {
            $topic = Yii::$app->params['mqtt']['topics']['linguas']['delete'] ?? 'vivaTur/linguas/delete';

            Yii::$app->mqtt->publishJson($topic, [
                'id' => $this->id,
                'nome' => $this->nome,
                'action' => 'delete',
                'timestamp' => date('Y-m-d H:i:s'),
            ]);
        } catch (\Exception $e) {
            Yii::error("MQTT publish falhou (Linguas/delete): " . $e->getMessage(), __METHOD__);
        }
    }

}
