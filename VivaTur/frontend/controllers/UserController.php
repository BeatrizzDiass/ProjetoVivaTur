<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use common\models\User;

class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Perfil do utilizador
     */
    public function actionProfile()
    {
        $user = User::findOne(Yii::$app->user->id);

        if (!$user) {
            throw new NotFoundHttpException('Utilizador não encontrado.');
        }

        if ($user->load(Yii::$app->request->post())) {
            $user->updated_at = time();

            if (!empty($user->new_password)) {
                if (strlen($user->new_password) < 6) {
                    Yii::$app->session->setFlash(
                        'error',
                        'A password deve ter no mínimo 6 caracteres.'
                    );
                    return $this->render('profile', [
                        'user' => $user,
                    ]);
                }

                $user->setPassword($user->new_password);
                $user->generateAuthKey();
            }

            if ($user->save()) {
                Yii::$app->session->setFlash('success', 'Perfil atualizado com sucesso!');
                return $this->refresh();
            }

            $errors = [];
            foreach ($user->errors as $fieldErrors) {
                $errors[] = implode(', ', $fieldErrors);
            }

            Yii::$app->session->setFlash(
                'error',
                'Erro ao atualizar perfil: ' . implode(' | ', $errors)
            );
        }

        return $this->render('profile', [
            'user' => $user,
        ]);
    }
}
