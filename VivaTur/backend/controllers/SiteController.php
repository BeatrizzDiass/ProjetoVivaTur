<?php

namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;

use backend\models\Experiencias;
use backend\models\User;
use backend\models\Categorias;
use backend\models\Linguas;
use backend\models\Paises;
use backend\models\Avaliacoes;
use backend\models\MetodoPagamentos;
use backend\models\Comentarios;
use backend\models\Reservas;
use backend\models\Gestores;



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
                        'roles' => ['?'],  // Guests podem aceder login e error
                    ],
                    [

                        'actions' => ['index', 'logout', 'users', 'experiencia', 'categorias', 'idioma', 'paises', 'avaliacoes', 'pagamento', 'comentarios', 'calendar'],
                        'allow' => true,
                        'roles' => ['admin', 'gestor'],  // Apenas admin e gestor
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    if (Yii::$app->user->isGuest) {
                        Yii::$app->session->setFlash('error', 'Por favor, faça login para continuar.');
                        return Yii::$app->response->redirect(['site/login']);
                    }


                    Yii::$app->session->setFlash('error', 'Você não tem permissão para aceder ao backend.');
                    //Yii::$app->user->logout();
                    return Yii::$app->response->redirect(['site/login']);
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
        $experiencesCount = Experiencias::find()->count();

        $categoriasCount = Categorias::find()->count();

        $userCount = User::find()->count();

        $idiomasCount = Linguas::find()->count();

        $paisesCount = Paises::find()->count();

        $avaliacoesCount = Avaliacoes::find()->count();

        $metodosPagamentoCount = MetodoPagamentos::find()->count();

        $comentariosCount = Comentarios::find()->count();

        $reservasCount = Reservas::find()->count();

        $gestoresCount = Gestores::find()->count();

        return $this->render('index', [
            'experiencesCount' => $experiencesCount,
            'categoriasCount' => $categoriasCount,
            'userCount' => $userCount,
            'idiomasCount' => $idiomasCount,
            'paisesCount' => $paisesCount,
            'avaliacoesCount' => $avaliacoesCount,
            'metodosPagamentoCount' => $metodosPagamentoCount,
            'comentariosCount' => $comentariosCount,
            'reservasCount' => $reservasCount,
            'gestoresCount' => $gestoresCount,
        ]);
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

            // verificar se tem acesso ao back-office
            $userRoles = array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->id));

            if (!in_array('admin', $userRoles) && !in_array('gestor', $userRoles)) {
                Yii::$app->user->logout();
                Yii::$app->session->setFlash('error', 'Acesso negado! Esta área é apenas para administradores e gestores de experiências');
                return $this->refresh(); // Recarrega a página de login
            }

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

    /**
     * @return string
     */
    public function actionCalendar()
    {
        $experiencias = Experiencias::find()
            ->select(['id', 'nome', 'dataDisponivel', 'horaInicio', 'horaFim', 'local'])
            ->all();

        // Formatar para o FullCalendar
        $eventos = [];
        foreach ($experiencias as $exp) {
            $eventos[] = [
                'id' => $exp['id'],
                'title' => $exp['nome'],
                'start' => $exp['dataDisponivel'] . 'T' . $exp['horaInicio'],
                'end' => $exp['dataDisponivel'] . 'T' . $exp['horaFim'],
                'extendedProps' => [
                    'local' => $exp['local']
                ],
                'url' => Url::to(['experiencias/view', 'id' => $exp['id']])
            ];
        }

        return $this->render('calendar', [
            'eventos' => json_encode($eventos)
        ]);
    }
}
