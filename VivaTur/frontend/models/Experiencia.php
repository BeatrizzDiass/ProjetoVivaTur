<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "experiencia".
 *
 * @property int $id
 * @property string $nome	 \
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
 * @property Avaliacao[] $avaliacaos
 * @property Categoria $categoria
 * @property Comentario[] $comentarios
 * @property Favorito[] $favoritos
 * @property Gestor $gestor
 * @property Pais $pais
 * @property Reserva[] $reservas
 */
class Experiencia extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'experiencia';
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
            [['categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::class, 'targetAttribute' => ['categoria_id' => 'id']],
            [['gestor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gestor::class, 'targetAttribute' => ['gestor_id' => 'id']],
            [['pais_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pais::class, 'targetAttribute' => ['pais_id' => 'id']],
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
     * Gets query for [[Avaliacaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAvaliacaos()
    {
        return $this->hasMany(Avaliacao::class, ['experiencia_id' => 'id']);
    }

    /**
     * Gets query for [[Categoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::class, ['id' => 'categoria_id']);
    }

    /**
     * Gets query for [[Comentarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentario::class, ['experiencia_id' => 'id']);
    }

    /**
     * Gets query for [[Favoritos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavoritos()
    {
        return $this->hasMany(Favorito::class, ['experiencia_id' => 'id']);
    }

    /**
     * Gets query for [[Gestor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGestor()
    {
        return $this->hasOne(Gestor::class, ['id' => 'gestor_id']);
    }

    /**
     * Gets query for [[Pais]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPais()
    {
        return $this->hasOne(Pais::class, ['id' => 'pais_id']);
    }

    /**
     * Gets query for [[Reservas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReservas()
    {
        return $this->hasMany(Reserva::class, ['experiencia_id' => 'id']);
    }

}
