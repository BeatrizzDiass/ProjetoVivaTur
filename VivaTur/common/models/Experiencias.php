<?php

namespace common\models;

use DateTime;
use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "experiencias".
 */
class Experiencias extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public static function tableName()
    {
        return 'experiencias';
    }

    public function rules()
    {
        return [
            [['nome','horaInicio', 'horaFim', 'local', 'dataDisponivel', 'precoPessoa', 'numMaxParticipante', 'numMinParticipante', 'categoria_id', 'gestor_id', 'pais_id'], 'required'],
            [['categoria_id', 'gestor_id', 'pais_id'], 'integer'],
            [['nome','horaInicio', 'horaFim', 'duracao', 'local', 'dataDisponivel', 'precoPessoa', 'numMaxParticipante', 'numMinParticipante'], 'string', 'max' => 45],
            [['categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categorias::class, 'targetAttribute' => ['categoria_id' => 'id']],
            [['gestor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gestores::class, 'targetAttribute' => ['gestor_id' => 'id']],
            [['pais_id'], 'exist', 'skipOnError' => true, 'targetClass' => Paises::class, 'targetAttribute' => ['pais_id' => 'id']],
            // ADICIONA ESTA LINHA - permite upload opcional
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'checkExtensionByMimeType' => false],
            [['descricao','imagem'], 'string', 'max' => 255],

            // Validação min/max participantes
            ['numMinParticipante', 'compare',
                'compareAttribute' => 'numMaxParticipante',
                'operator' => '<=',
                'message' => 'O número mínimo de participantes não pode ser maior que o número máximo.'
            ],

            [['horaInicio', 'dataDisponivel'], 'validarHorario'],
        ];
    }

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

    // Relações
    public function getAvaliacoes()
    {
        return $this->hasMany(Avaliacoes::class, ['experiencia_id' => 'id']);
    }

    public function getCategoria()
    {
        return $this->hasOne(Categorias::class, ['id' => 'categoria_id']);
    }

    public function getComentarios()
    {
        return $this->hasMany(Comentarios::class, ['experiencia_id' => 'id']);
    }

    public function getFavoritos()
    {
        return $this->hasMany(Favoritos::class, ['experiencia_id' => 'id']);
    }

    public function getGestor()
    {
        return $this->hasOne(Gestores::class, ['id' => 'gestor_id']);
    }

    public function getPais()
    {
        return $this->hasOne(Paises::class, ['id' => 'pais_id']);
    }

    public function getReservas()
    {
        return $this->hasMany(Reservas::class, ['experiencia_id' => 'id']);
    }

    // ADICIONA ESTES MÉTODOS
    public function calcularDuracao()
    {
        if ($this->horaInicio && $this->horaFim) {
            $inicio = new DateTime($this->horaInicio);
            $fim = new DateTime($this->horaFim);

            $intervalo = $inicio->diff($fim);

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

    public function uploadImage()
    {
        if ($this->imageFile) {
            $uploadPath = Yii::getAlias('@webroot/uploads/');

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $filename = uniqid() . '.' . $this->imageFile->extension;
            $filePath = $uploadPath . $filename;

            if ($this->imageFile->saveAs($filePath)) {
                if (!empty($this->imagem)) {
                    $oldFile = $uploadPath . $this->imagem;
                    if (file_exists($oldFile)) {
                        unlink($oldFile);
                    }
                }

                $this->imagem = $filename;
                return true;
            }
        }
        return false;
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

        if (strpos($this->imagem, '.') !== false) {
            return $this->imagem;
        }

        $basePath = Yii::getAlias('@webroot/uploads/');
        $extensions = ['jpg', 'jpeg', 'png'];

        foreach ($extensions as $ext) {
            if (file_exists($basePath . $this->imagem . '.' . $ext)) {
                return $this->imagem . '.' . $ext;
            }
        }

        return $this->imagem . '.jpg';
    }

    public function fields()
    {
        $fields = parent::fields();

        $fields['imagem'] = function($model) {
            return $model->imagemUrl;
        };

        return $fields;
    }

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

        try {
            $baseTopic = Yii::$app->params['mqtt']['topics']['experiencias'] ?? 'vivaTur/experiencias';
            $action = $insert ? 'INSERT' : 'UPDATE';

            $payload = [
                'entity' => 'experiencia',
                'action' => $action,
                'id' => (int) $this->id,
                'ts' => time(),
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
}