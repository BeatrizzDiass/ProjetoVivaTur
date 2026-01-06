<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "experiencia".
 *
 * @property int $id
 * @property string $nome
 * @property string $descricao
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
 * @property Gestores $gestor
 * @property Paises $pais
 * @property Avaliacoes[] $avaliacoes
 * @property Comentarios[] $comentarios
 * @property Favoritos[] $favoritos
 * @property Reservas[] $reservas
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
            [['nome', 'descricao', 'horaInicio', 'horaFim', 'duracao', 'local', 'dataDisponivel', 'precoPessoa', 'numMaxParticipante', 'numMinParticipante', 'categoria_id', 'gestor_id', 'pais_id'], 'required'],
            [['dataDisponivel'], 'safe'],
            [['categoria_id', 'gestor_id', 'pais_id'], 'integer'],
            [['nome', 'horaInicio', 'horaFim', 'duracao', 'local', 'precoPessoa', 'numMaxParticipante', 'numMinParticipante'], 'string', 'max' => 45],
            [['descricao'], 'string', 'max' => 255],
            [['imagem'], 'string', 'max' => 255],
            [['categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categorias::class, 'targetAttribute' => ['categoria_id' => 'id']],
            [['gestor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gestores::class, 'targetAttribute' => ['gestor_id' => 'id']],
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
            'descricao' => 'Descrição',
            'horaInicio' => 'Hora Início',
            'horaFim' => 'Hora Fim',
            'duracao' => 'Duração',
            'local' => 'Local',
            'dataDisponivel' => 'Data Disponível',
            'precoPessoa' => 'Preço por Pessoa',
            'imagem' => 'Imagem',
            'numMaxParticipante' => 'Número Máximo de Participantes',
            'numMinParticipante' => 'Número Mínimo de Participantes',
            'categoria_id' => 'Categoria',
            'gestor_id' => 'Gestor',
            'pais_id' => 'País',
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
     * Gets query for [[Gestor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGestor()
    {
        return $this->hasOne(Gestores::class, ['id' => 'gestor_id']);
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

    /**
     * Gets query for [[Avaliacoes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAvaliacoes()
    {
        return $this->hasMany(Avaliacoes::class, ['experiencia_id' => 'id']);
    }

    /**
     * Gets query for [[Comentarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentarios::class, ['experiencia_id' => 'id']);
    }

    /**
     * Gets query for [[Favoritos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavoritos()
    {
        return $this->hasMany(Favoritos::class, ['experiencia_id' => 'id']);
    }

    /**
     * Gets query for [[Reservas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReservas()
    {
        return $this->hasMany(Reservas::class, ['experiencia_id' => 'id']);
    }

    /**
     * Calcula as vagas disponíveis para esta experiência
     */
    public function getVagasDisponiveis()
    {
        $totalReservado = Reservas::find()
            ->where(['experiencia_id' => $this->id])
            ->sum('numPessoas');

        return $this->numMaxParticipante - ($totalReservado ?? 0);
    }
}