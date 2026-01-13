<?php

namespace backend\models;

use DateTime;
use Yii;

use yii\web\UploadedFile;

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
     * @var UploadedFile
     */
    public $imageFile;

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
            [['nome','horaInicio', 'horaFim', 'local', 'dataDisponivel', 'precoPessoa', 'numMaxParticipante', 'numMinParticipante', 'categoria_id', 'gestor_id', 'pais_id'], 'required'],
            [['categoria_id', 'gestor_id', 'pais_id'], 'integer'],
            [['nome','horaInicio', 'horaFim', 'duracao', 'local', 'dataDisponivel', 'precoPessoa', 'numMaxParticipante', 'numMinParticipante'], 'string', 'max' => 45],
            [['categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categorias::class, 'targetAttribute' => ['categoria_id' => 'id']],
            [['gestor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gestores::class, 'targetAttribute' => ['gestor_id' => 'id']],
            [['pais_id'], 'exist', 'skipOnError' => true, 'targetClass' => Paises::class, 'targetAttribute' => ['pais_id' => 'id']],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'checkExtensionByMimeType' => false],
            [['descricao','imagem'], 'string', 'max' => 255],

            // Regra de validação para garantir que numMinParticipante <= numMaxParticipante
            ['numMinParticipante', 'compare',
                'compareAttribute' => 'numMaxParticipante',
                'operator' => '<=',
                'message' => 'O número mínimo de participantes não pode ser maior que o número máximo.'
            ],

            [['horaInicio', 'dataDisponivel'], 'validarHorario'],
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
            'descricao' => 'Descricao',
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


    public function calcularDuracao(){
        if ($this->horaInicio && $this->horaFim) {
            $inicio = new DateTime($this->horaInicio);
            $fim = new DateTime($this->horaFim);

            $intervalo = $inicio->diff($fim);

            // Formatar como "Xh Ym" ou apenas horas/minutos se um deles for 0
            $horas = $intervalo->h;
            $minutos = $intervalo->i;

            if ($horas > 0 && $minutos > 0) {
                $this->duracao = $horas . 'h ' . $minutos . 'm';
            } elseif ($horas > 0) {
                $this->duracao = $horas . 'h';
            } else {
                $this->duracao = $minutos . 'm';
            }
        }
    }

// Adicionar no beforeSave para calcular automaticamente
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->calcularDuracao();
            return true;
        }
        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        // Notificações MQTT (slides: afterSave/afterDelete)
        try {
            $baseTopic = Yii::$app->params['mqtt']['topics']['experiencias'] ?? 'vivaTur/experiencias';
            $action = $insert ? 'INSERT' : 'UPDATE';

            $payload = [
                'entity' => 'experiencia',
                'action' => $action,
                'id' => (int) $this->id,
                'ts' => time(),
                // dados mínimos para o cliente decidir se precisa de sincronizar via REST
                'data' => $this->toArray(),
                'changed' => array_keys((array) $changedAttributes),
            ];

            Yii::$app->mqtt->publishJson($baseTopic . '/' . strtolower($action), $payload);
        } catch (\Throwable $e) {
            Yii::warning('Falha ao publicar notificação MQTT (experiencias afterSave): ' . $e->getMessage(), __METHOD__);
        }
    }

    public function afterDelete()
    {
        // guardar estado antes do parent (por segurança)
        $snapshot = $this->toArray();

        parent::afterDelete();

        try {
            $baseTopic = Yii::$app->params['mqtt']['topics']['experiencias'] ?? 'vivaTur/experiencias';
            $payload = [
                'entity' => 'experiencia',
                'action' => 'DELETE',
                'id' => (int) ($snapshot['id'] ?? 0),
                'ts' => time(),
                'data' => $snapshot,
            ];

            Yii::$app->mqtt->publishJson($baseTopic . '/delete', $payload);
        } catch (\Throwable $e) {
            Yii::warning('Falha ao publicar notificação MQTT (experiencias afterDelete): ' . $e->getMessage(), __METHOD__);
        }
    }

    public function validarHorario($attribute, $params)
    {
        $query = self::find()
            ->where([
                'horaInicio' => $this->horaInicio,
                'dataDisponivel' => $this->dataDisponivel,
                'local' => $this->local,
            ]);

        if (!$this->isNewRecord) {
            $query->andWhere(['!=', 'id', $this->id]);
        }

        if ($query->exists()) {
            $this->addError($attribute, 'Já existe uma experiência agendada para este horário, data e local.');
        }
    }


    public function getImagemUrl()
    {
        if (empty($this->imagem)) {
            return null;
        }

        // Se já tiver extensão, retorna como está
        if (strpos($this->imagem, '.') !== false) {
            return $this->imagem;
        }

        // Se não tiver extensão, procura o arquivo
        $basePath = Yii::getAlias('@webroot/uploads/');

        // Tenta as extensões mais comuns
        $extensions = ['jpg', 'jpeg', 'png'];

        foreach ($extensions as $ext) {
            if (file_exists($basePath . $this->imagem . '.' . $ext)) {
                return $this->imagem . '.' . $ext;
            }
        }

        // Se não encontrar, retorna com .jpg (padrão)
        return $this->imagem . '.jpg';
    }

    public function fields()
    {
        $fields = parent::fields();

        // Substitui o campo 'imagem' para usar o getter que adiciona a extensão
        $fields['imagem'] = function($model) {
            return $model->imagemUrl;
        };

        return $fields;
    }

}
