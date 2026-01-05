<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use frontend\models\Favorito;
use frontend\models\Turistas; // Não esquecer de importar o model Turistas
use yii\web\Response;
use yii\web\NotFoundHttpException;

class FavoritoController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['turista'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => \yii\filters\VerbFilter::class,
                'actions' => [
                    'create' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lista os favoritos do turista atual
     */
    public function actionIndex()
    {
        $turista = Turistas::findOne(['user_id' => Yii::$app->user->id]);

        if (!$turista) {
            throw new NotFoundHttpException('Perfil de turista não encontrado.');
        }

        $favoritos = Favorito::find()
            ->where(['turista_id' => $turista->id]) // Alterado para turista_id
            ->with('experiencia')
            ->all();

        return $this->render('index', [
            'favoritos' => $favoritos,
        ]);
    }

    public function actionCreate($id_experiencia)
    {
        $turista = Turistas::findOne(['user_id' => Yii::$app->user->id]);

        if (!$turista) {
            Yii::$app->session->setFlash('error', 'Precisa de um perfil de turista para favoritar.');
            return $this->redirect(Yii::$app->request->referrer ?: ['site/index']);
        }

        // Verifica se já existe o favorito para este turista
        $favorito = Favorito::find()
            ->where(['experiencia_id' => $id_experiencia, 'turista_id' => $turista->id])
            ->one();

        if ($favorito) {
            $favorito->delete();
            Yii::$app->session->setFlash('success', 'Removido dos favoritos.');
        } else {
            $favorito = new Favorito();
            $favorito->experiencia_id = $id_experiencia;
            $favorito->turista_id = $turista->id; // Alterado para turista_id

            if ($favorito->save()) {
                Yii::$app->session->setFlash('success', 'Adicionado aos favoritos!');
            } else {
                Yii::$app->session->setFlash('error', 'Erro ao adicionar aos favoritos.');
            }
        }

        return $this->redirect(Yii::$app->request->referrer ?: ['site/index']);
    }
}