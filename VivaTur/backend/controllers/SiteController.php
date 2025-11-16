<?php

namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
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
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => [
                            'logout',
                            'index',
                            // Adicionar as novas ações aqui
                            'users',
                            'experiencia',
                            'categorias',
                            'idioma',
                            'paises',
                            'avaliacoes',
                            'pagamento',
                            'comentarios',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * @return string
     */
    public function actionUsers()
    {
        return $this->render('users');
    }

    /**
     * @return string
     */
    public function actionExperiencia()
    {
        return $this->render('experiencia');
    }

    /**
     * @return string
     */
    public function actionCategorias()
    {
        return $this->render('categorias');
    }

    /**
     * @return string
     */
    public function actionIdioma()
    {
        return $this->render('idioma');
    }

    /**
     * @return string
     */
    public function actionPaises()
    {
        return $this->render('paises');
    }

    /**
     * @return string
     */
    public function actionAvaliacoes()
    {
        return $this->render('avaliacoes');
    }

    /**
     * @return string
     */
    public function actionPagamento()
    {
        return $this->render('pagamento');
    }

    /**
     * @return string
     */
    public function actionComentarios()
    {
        return $this->render('comentarios');
    }
}
