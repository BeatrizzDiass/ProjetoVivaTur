<?php

namespace frontend\models;

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
 * @property Avaliacoes[] $avaliacoes
 * @property Categorias $categoria
 * @property Comentarios[] $comentarios
 * @property Favoritos[] $favoritos
 * @property Gestores $gestor
 * @property Paises $pais
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
            [['nome', 'horaInicio', 'horaFim', 'duracao', 'local', 'dataDisponivel', 'precoPessoa', 'imagem', 'numMaxParticipante', 'numMinParticipante', 'categoria_id', 'gestor_id', 'pais_id'], 'required'],
            [['categoria_id', 'gestor_id', 'pais_id'], 'integer'],
            [['nome', 'horaInicio', 'horaFim', 'duracao', 'local', 'dataDisponivel', 'precoPessoa', 'imagem', 'numMaxParticipante', 'numMinParticipante'], 'string', 'max' => 45],
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
     * Gets query for [[Avaliacoes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAvaliacoes()
    {
        return $this->hasMany(Avaliacoes::class, ['experiencia_id' => 'id']);
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
     * Gets query for [[Reservas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReservas()
    {
        return $this->hasMany(Reservas::class, ['experiencia_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        // If you have a user_id column in experiencias table:
        return $this->hasOne(User::class, ['id' => 'user_id']);

        // OR if the user relation is through gestor:
        // return $this->hasOne(User::class, ['id' => 'gestor_id']);
    }


    public function getVagasDisponiveis()
    {
        // Soma o total de pessoas que já reservaram esta experiência
        $totalReservado = Reservas::find()
            ->where(['experiencia_id' => $this->id])
            ->sum('numPessoas');

        // Se não houver reservas, retorna o máximo
        if ($totalReservado === null) {
            $totalReservado = 0;
        }

        // Calcula vagas disponíveis
        return $this->numMaxParticipante - $totalReservado;
    }

    public function vagasexperiencia($quantidade)
    {
        return $this->getVagasDisponiveis() >= $quantidade;
    }


}
