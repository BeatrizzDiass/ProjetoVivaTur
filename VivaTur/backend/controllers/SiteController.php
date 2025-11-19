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

                'denyCallback' => function ($rule, $action) {
                    if (Yii::$app->user->isGuest) {
                        Yii::$app->session->setFlash('error', 'Acesso negado. Você precisa estar autenticado para aceder à área de administração.');
                        return $this->redirect(['site/login']); // redireciona para a ação index do controller site
                        // Se estiver logado mas sem permissão (ex: Turista)
                        Yii::$app->session->setFlash('error', 'Você não tem permissão para aceder à área de administração.');
                        return Yii::$app->response->redirect(['/site/login']); // ou outra página apropriada
                    }
                }
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

        // Apaga todos os cookies do backend, mas preserva a sessão
        $cookies = Yii::$app->response->cookies;
        $requestCookies = Yii::$app->request->cookies;

        foreach ($requestCookies as $cookie) {
            if ($cookie->name !== Yii::$app->session->name) {
                $cookies->remove($cookie->name);
            }
        }

        // Redireciona para o login do backend
        return $this->redirect(['site/login']);
    }

    /**
     * @return string
     */
    public function actionUsers()
    {
        if (!Yii::$app->user->can('viewUsers')) {
            throw new \yii\web\ForbiddenHttpException('Você não tem permissão para aceder a esta página.');
        }

        return $this->render('index');
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
