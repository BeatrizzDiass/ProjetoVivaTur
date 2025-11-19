<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $verification_token
 *
 * @property Comentario[] $comentarios
 * @property Favorito[] $favoritos
 * @property Gestor[] $gestors
 * @property Reserva[] $reservas
 */
class User extends \yii\db\ActiveRecord
{

    public $password;

    public $role; // Propriedade para armazenar o role selecionado no formulário


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */


    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                // Mapeia para as colunas inteiras (tipo TIMESTAMP ou INT) da tabela
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                // O valor padrão é time(), que retorna o timestamp Unix (um inteiro)
                // com a hora atual, preenchendo o 'created_at' e 'updated_at' no momento do save.
                // Se suas colunas fossem do tipo DATETIME, você usaria: 'value' => new \yii\db\Expression('NOW()')
            ],
        ];
    }

    public function rules()
    {
        return [
            [['username', 'email'], 'required'],
            [['username', 'email'], 'unique'],
            ['email', 'email'],

            [['username', 'password_reset_token', 'email', 'verification_token'], 'string', 'max' => 255],

            ['status', 'integer'],

            // Regra para a password vinda do formulário
            ['password', 'required', 'on' => 'create'], // Exige password ao criar
            ['password', 'string', 'min' => 6], // Mínimo de 6 caracteres

            ['role', 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => 'Verification Token',
        ];
    }

    /**
     * Gets query for [[Comentarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentario::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Favoritos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavoritos()
    {
        return $this->hasMany(Favorito::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Gestors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGestors()
    {
        return $this->hasMany(Gestor::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Reservas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReservas()
    {
        return $this->hasMany(Reserva::class, ['user_id' => 'id']);
    }



    public function setPassword($password)
    {
        // O Yii::$app->security garante um hash forte (bcrypt) com salt automático
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }


    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                // Garante que a Auth Key seja gerada na criação
                $this->auth_key = Yii::$app->security->generateRandomString();
                // Garante que o token de verificação de email seja gerado na criação
                $this->generateEmailVerificationToken();
            }

            // GERAÇÃO DA PASSWORD HASH:
            // Verifica se o campo de senha foi preenchido.
            // O campo 'password' não existe no banco, mas pode ser usado no formulário.
            if (!empty($this->password)) {
                $this->setPassword($this->password);
            }

            return true;
        }
        return false;
    }


    public function getRoles()
    {
        $auth = Yii::$app->authManager;
        return $auth->getRolesByUser($this->id);
    }


    public static function getAllRolesList()
    {
        $auth = Yii::$app->authManager;
        $roles = $auth->getRoles();

        $list = [];
        foreach ($roles as $roleName => $role) {
            $list[$roleName] = $role->description ?: $roleName;
        }
        return $list;
    }

}