<?php

namespace backend\modules\api\controllers;

use Exception;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use function PHPUnit\Framework\throwException;

class UsersController extends ActiveController
{
    public $modelClass = 'common\models\User';


    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::class,
            'except' => ['*'],
        ];

        return $behaviors;
    }

    //obter dados do utilizador autenticado
    //URL: api/users/me
    public function actionMe()
    {
        $user = \Yii::$app->user->identity;

        if ($user === null) {
            throw new Exception("User nao autenticado.");
        }

        return $user;
    }

    //atualizar dados do utilizador autenticado
    //URL: api/users/putme
    public function actionPutme()
    {
        $user = \Yii::$app->user->identity;

        if ($user === null) {
            throw new \yii\web\UnauthorizedHttpException("User não autenticado.");
        }

        // Atualizar campos
        $user->username = \Yii::$app->request->post('username', $user->username);
        $user->email = \Yii::$app->request->post('email', $user->email);

        // Se enviar password, atualiza também
        $newPassword = \Yii::$app->request->post('password');
        if ($newPassword) {
            $user->setPassword($newPassword);
        }

        if ($user->save()) {
            return [
                'success' => true,
                'message' => 'Dados atualizados com sucesso',
                'user' => [
                    'id' => $user->id,
                    'username' => $user->username,
                    'email' => $user->email
                ]
            ];
        } else {
            throw new \yii\web\BadRequestHttpException(json_encode($user->getErrors()));
        }
    }
}
