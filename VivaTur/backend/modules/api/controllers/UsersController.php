<?php
namespace backend\modules\api\controllers;

use Exception;
use yii\rest\ActiveController;
use function PHPUnit\Framework\throwException;

class UsersController extends ActiveController
{
    public $modelClass = 'common\models\User';
    

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
            throw new Exception("User nao autenticado.");
        }

        // Atualizar campos permitidos
        $user->username = \Yii::$app->request->post('username', $user->username);
        $user->email = \Yii::$app->request->post('email', $user->email);

        // Se enviar password, atualiza também
        $newPassword = \Yii::$app->request->post('password');
        if ($newPassword) {
            $user->setPassword($newPassword);
        }

        if ($user->save()) {
            throw new Exception("Dados do utilizador atualizados com sucesso.");
        }
        else {
            throw new Exception("Erro ao atualizar os dados do utilizador.");
        }
    }
}
