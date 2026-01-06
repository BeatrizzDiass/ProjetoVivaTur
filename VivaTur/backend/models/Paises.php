<?php

namespace backend\models;

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

    /**
     * afterSave: publica notificação MQTT quando um país é criado/atualizado
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        try {
            $acao = $insert ? 'insert' : 'update';
            $topic = Yii::$app->params['mqtt']['topics']['paises'][$acao] ?? "vivaTur/paises/{$acao}";

            Yii::$app->mqtt->publishJson($topic, [
                'id' => $this->id,
                'nome' => $this->nome,
                'action' => $acao,
                'timestamp' => date('Y-m-d H:i:s'),
            ]);
        } catch (\Exception $e) {
            Yii::error("MQTT publish falhou (Paises/{$acao}): " . $e->getMessage(), __METHOD__);
        }
    }

    /**
     * afterDelete: publica notificação MQTT quando um país é apagado
     */
    public function afterDelete()
    {
        parent::afterDelete();

        try {
            $topic = Yii::$app->params['mqtt']['topics']['paises']['delete'] ?? 'vivaTur/paises/delete';

            Yii::$app->mqtt->publishJson($topic, [
                'id' => $this->id,
                'nome' => $this->nome,
                'action' => 'delete',
                'timestamp' => date('Y-m-d H:i:s'),
            ]);
        } catch (\Exception $e) {
            Yii::error("MQTT publish falhou (Paises/delete): " . $e->getMessage(), __METHOD__);
        }
    }

}
