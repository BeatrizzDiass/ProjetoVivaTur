<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "experiencias".
 *
 * @property int $id
 * @property string $nome
 * @property string $horaInicio
 * @property string $horaFim
 * @property string $duracao
 * @property string $local
 * @property string $dataDisponivel
 * @property string $precoPessoa
 * @property string $imagem
 * @property string $numMaxParticipante
 * @property string $numMinParticipante
 * @property int $categoria_id
 * @property int $gestor_id
 * @property int $pais_id
 *
 * @property Categorias $categoria
 * @property Paises $pais
 */
class Experiencias extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'experiencias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'horaInicio', 'horaFim', 'duracao', 'local', 'dataDisponivel', 'precoPessoa', 'imagem', 'numMaxParticipante', 'numMinParticipante', 'categoria_id', 'gestor_id', 'pais_id'], 'required'],
            [['categoria_id', 'gestor_id', 'pais_id'], 'integer'],
            [['nome', 'horaInicio', 'horaFim', 'duracao', 'local', 'dataDisponivel', 'precoPessoa', 'imagem', 'numMaxParticipante', 'numMinParticipante'], 'string', 'max' => 45],
            [['categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categorias::class, 'targetAttribute' => ['categoria_id' => 'id']],
            [['pais_id'], 'exist', 'skipOnError' => true, 'targetClass' => Paises::class, 'targetAttribute' => ['pais_id' => 'id']],
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
            'horaInicio' => 'Hora Inicio',
            'horaFim' => 'Hora Fim',
            'duracao' => 'Duracao',
            'local' => 'Local',
            'dataDisponivel' => 'Data Disponivel',
            'precoPessoa' => 'Preco Pessoa',
            'imagem' => 'Imagem',
            'numMaxParticipante' => 'Num Max Participante',
            'numMinParticipante' => 'Num Min Participante',
            'categoria_id' => 'Categoria ID',
            'gestor_id' => 'Gestor ID',
            'pais_id' => 'Pais ID',
        ];
    }

    /**
     * Gets query for [[Categoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categorias::class, ['id' => 'categoria_id']);
    }

    /**
     * Gets query for [[Pais]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPais()
    {
        return $this->hasOne(Paises::class, ['id' => 'pais_id']);
    }

}
