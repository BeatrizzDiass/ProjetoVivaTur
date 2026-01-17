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
		$request = \Yii::$app->request;

		// Isto permite ler tanto JSON (App) como Form-Data (Site)
		$username = $request->getBodyParam('username') ?: $request->post('username');
		$password = $request->getBodyParam('password') ?: $request->post('password');

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

		// Usamos o auth_key que já existe na BD para ambos os casos
		// Se o auth_key estiver vazio, geramos um. Se já existir, podemos reutilizar ou renovar.
		$user->auth_key = \Yii::$app->security->generateRandomString(64);

		if (!$user->save(false)) {
			throw new ServerErrorHttpException('Erro ao atualizar o token.');
		}

		return [
			'id' => $user->id,
			'username' => $user->username,
			'email' => $user->email,
			'token' => $user->auth_key, // Enviamos como "token" para a App ler
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