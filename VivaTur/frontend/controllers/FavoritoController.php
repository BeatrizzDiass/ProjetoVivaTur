<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use frontend\models\Favorito;
use yii\web\Response;

class FavoritoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // Apenas usuários autenticados
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
     * Lista os favoritos do utilizador atual
     */
    public function actionIndex()
    {
        $userId = Yii::$app->user->id;
        
        // Busca todos os favoritos do utilizador logado
        $favoritos = Favorito::find()
            ->where(['user_id' => $userId])
            ->with('experiencia') // Carrega logo os dados da experiência para evitar muitas queries
            ->all();

        return $this->render('index', [
            'favoritos' => $favoritos,
        ]);
    }

    public function actionCreate($id_experiencia)
    {
        $userId = Yii::$app->user->id;

        // Verifica se já existe
        $favorito = Favorito::find()
            ->where(['experiencia_id' => $id_experiencia, 'user_id' => $userId])
            ->one();

        if ($favorito) {
            // Se já existe, remove (toggle)
            $favorito->delete();
            Yii::$app->session->setFlash('success', 'Removido dos favoritos.');
        } else {
            // Se não existe, cria
            $favorito = new Favorito();
            $favorito->experiencia_id = $id_experiencia;
            $favorito->user_id = $userId;
            
            if ($favorito->save()) {
                Yii::$app->session->setFlash('success', 'Adicionado aos favoritos!');
            } else {
                Yii::$app->session->setFlash('error', 'Erro ao adicionar aos favoritos.');
            }
        }

        // Redireciona de volta para a página anterior
        return $this->redirect(Yii::$app->request->referrer ?: ['site/index']);
    }
}
