<?php
namespace backend\modules\api\controllers;

use common\models\User;
use yii\filters\auth\QueryParamAuth;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;
use yii\web\UnauthorizedHttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

class AuthController extends Controller
{

public function behaviors()
{
    $behaviors = parent::behaviors();
    // Remove ou ajusta o authenticator para a action 'login'
    $behaviors['authenticator']['except'] = ['login']; 
    return $behaviors;
}

    public $enableCsrfValidation = false;

    /* ================= LOGIN ================= */
    // POST /api/auth/login
	public function actionLogin()
	{
		// bodyParams permite ler o JSON que vem do Android
		$params = \Yii::$app->request->bodyParams;
		$username = $params['username'] ?? \Yii::$app->request->post('username');
		$password = $params['password'] ?? \Yii::$app->request->post('password');

		if (!$username || !$password) {
			throw new BadRequestHttpException('Username e password são obrigatórios.');
		}

		$user = User::findOne([
			'username' => $username,
			'status' => User::STATUS_ACTIVE
		]);

		if (!$user || !$user->validatePassword($password)) {
			throw new UnauthorizedHttpException('Credenciais inválidas.');
		}

		// ALTERAÇÃO CRÍTICA: Mudar access_token para auth_key
		// O auth_key é o campo padrão do Yii2 que o Site e a App podem partilhar
		$user->auth_key = \Yii::$app->security->generateRandomString(64);

		if (!$user->save(false)) {
			throw new ServerErrorHttpException('Erro ao gerar token.');
		}

		return [
			'id' => $user->id,
			'username' => $user->username,
			'email' => $user->email,
			'token' => $user->auth_key, // Enviamos como "token" para a App
		];
	}

    /* ================= REGISTER ================= */
    // POST /api/auth/register
    public function actionRegister()
    {
        $request = \Yii::$app->request;

        $username = $request->post('username');
        $email = $request->post('email');
        $password = $request->post('password');

        if (!$username || !$email || !$password) {
            throw new BadRequestHttpException('Username, email e password são obrigatórios.');
        }

        if (User::find()->where(['username' => $username])->exists()) {
            throw new BadRequestHttpException('Username já existe.');
        }

        if (User::find()->where(['email' => $email])->exists()) {
            throw new BadRequestHttpException('Email já existe.');
        }

        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->setPassword($password);
        $user->status = User::STATUS_ACTIVE;
        $user->generateAuthKey();

        if (!$user->save()) {
            throw new ServerErrorHttpException('Erro ao criar utilizador.');
        }

        return [
            'message' => 'Utilizador criado com sucesso.',
            'id' => $user->id,
        ];
    }

    /* ================= RECOVER ================= */
    // POST /api/auth/recover
    public function actionRecover()
    {
        $email = \Yii::$app->request->post('email');

        if (!$email) {
            throw new BadRequestHttpException('Email é obrigatório.');
        }

        $user = User::findOne(['email' => $email]);

        if (!$user) {
            throw new NotFoundHttpException('Utilizador não encontrado.');
        }

        $user->password_reset_token = \Yii::$app->security->generateRandomString() . '_' . time();

        if (!$user->save(false)) {
            throw new ServerErrorHttpException('Erro ao gerar token de recuperação.');
        }

        // Aqui futuramente envias email
        return [
            'message' => 'Instruções de recuperação enviadas para o email.',
        ];
    }
}