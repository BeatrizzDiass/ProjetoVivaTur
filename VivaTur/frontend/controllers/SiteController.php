<?php

namespace frontend\controllers;

use frontend\models\Gestores;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\Categorias;
use backend\models\Paises;
use frontend\models\Experiencias;
use yii\web\NotFoundHttpException;
use frontend\models\Comentarios;
use frontend\models\Avaliacoes;
use frontend\models\Metodopagamentos;
use frontend\models\Reservas;
use frontend\models\Turistas;
use common\models\User;

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
                'only' => ['logout', 'signup', 'profile'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'profile'],
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
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        // Receber os parâmetros do GET
        $pesquisa = Yii::$app->request->get('pesquisa');
        $categoriaId = Yii::$app->request->get('categoria');
        $paisId = Yii::$app->request->get('pais');

        // Criar a query
        $query = Experiencias::find();

        // Se o utilizador estiver logado e for um gestor, mostrar apenas as suas experiências
        if (!Yii::$app->user->isGuest) {
            $userId = Yii::$app->user->id;
            $gestor = Gestores::findOne(['user_id' => $userId]);

            if ($gestor) {
                // Se for gestor, filtra apenas as experiências dele
                $query->andWhere(['gestor_id' => $gestor->id]);
            }
        }

        // Aplicar filtros se existirem
        if (!empty($pesquisa)) {
            $query->andWhere(['like', 'nome', $pesquisa]);
        }

        if (!empty($categoriaId)) {
            $query->andWhere(['categoria_id' => $categoriaId]);
        }

        if (!empty($paisId)) {
            $query->andWhere(['pais_id' => $paisId]);
        }

        $experiencias = $query->all();
        $categorias = Categorias::find()->all();
        $paises = Paises::find()->all();

        return $this->render('index', [
            'experiencias' => $experiencias,
            'categorias' => $categorias,
            'paises' => $paises,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

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
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($model->verifyEmail()) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }

    public function actionService()
    {
        return $this->render('service');
    }

    public function actionTeam()
    {
        return $this->render('team');
    }

    /**
     * Exibe os detalhes de uma experiência
     */
    public function actionDetalhes($id)
    {
        $experiencia = Experiencias::findOne($id);

        if ($experiencia === null) {
            throw new NotFoundHttpException('Experiência não encontrada.');
        }

        // VERIFICAR SE O UTILIZADOR ESTÁ LOGADO PRIMEIRO
        if (Yii::$app->user->isGuest) {
            // Se não estiver logado, renderiza a página SEM permitir comentar/avaliar
            return $this->render('detalhes', [
                'experiencia' => $experiencia,
                'novoComentario' => null,
                'novaAvaliacao' => null,
            ]);
        }

        // Agora sim, buscar user e turista (só se estiver logado)
        $user = Yii::$app->user->identity;

        // Buscar turista usando namespace completo para evitar problemas
        $turista = Turistas::findOne(['user_id' => $user->id]);

        if (!$turista) {
            Yii::$app->session->setFlash('error', 'Perfil de turista não encontrado.');
            return $this->redirect(['index']);
        }

        // Preparar novo comentário
        $novoComentario = new Comentarios();
        $novoComentario->experiencia_id = $id;
        $novoComentario->turista_id = $turista->id;
        $novoComentario->dataCriacao = date('Y-m-d H:i:s');

        // Processar submissão de comentário
        if ($novoComentario->load(Yii::$app->request->post())) {
            if ($novoComentario->save()) {
                Yii::$app->session->setFlash('success', 'Comentário adicionado com sucesso!');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash(
                    'error',
                    'Erro ao adicionar comentário: ' . implode(', ', $novoComentario->getFirstErrors())
                );
            }
        }

        // Preparar nova avaliação
        $novaAvaliacao = new Avaliacoes();

        // Processar submissão de avaliação
        if ($novaAvaliacao->load(Yii::$app->request->post())) {
            $novaAvaliacao->experiencia_id = $id;
            $novaAvaliacao->turista_id = $turista->id;

            if ($novaAvaliacao->save()) {
                Yii::$app->session->setFlash('success', 'Avaliação adicionada com sucesso!');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash(
                    'error',
                    'Erro ao adicionar avaliação: ' . implode(', ', $novaAvaliacao->getFirstErrors())
                );
            }
        }

        return $this->render('detalhes', [
            'experiencia' => $experiencia,
            'novoComentario' => $novoComentario,
            'novaAvaliacao' => $novaAvaliacao,
        ]);
    }

    public function actionProfile()
    {
        // Buscar o usuário do common\models\User (que tem setPassword)
        $user = User::findOne(Yii::$app->user->id);

        if (!$user) {
            throw new NotFoundHttpException('Utilizador não encontrado.');
        }

        if ($user->load(Yii::$app->request->post())) {
            // Atualizar updated_at
            $user->updated_at = time();

            // Se foi fornecida uma nova password
            if (!empty($user->new_password)) {
                if (strlen($user->new_password) >= 6) {
                    $user->setPassword($user->new_password);
                    $user->generateAuthKey();
                } else {
                    Yii::$app->session->setFlash('error', 'A password deve ter no mínimo 6 caracteres.');
                    return $this->render('profile', ['user' => $user]);
                }
            }

            if ($user->save()) {
                Yii::$app->session->setFlash('success', 'Perfil atualizado com sucesso!');
                return $this->refresh();
            } else {
                $errors = [];
                foreach ($user->errors as $field => $fieldErrors) {
                    $errors[] = implode(', ', $fieldErrors);
                }
                Yii::$app->session->setFlash('error', 'Erro ao atualizar perfil: ' . implode(' | ', $errors));
            }
        }

        return $this->render('profile', [
            'user' => $user,
        ]);
    }

    public function actionExperienciasAvaliadas()
    {
        // Primeiro busca o turista pelo user_id
        $turista = Turistas::findOne(['user_id' => Yii::$app->user->id]);

        // Depois busca as avaliações usando o turista->id
        $avaliacoes = Avaliacoes::find()->where(['turista_id' => $turista->id])->all();

        return $this->render('experienciasAvaliadas', [
            'avaliacoes' => $avaliacoes,
        ]);
    }

    public function actionExperienciasComentadas()
    {
        $turista = Turistas::findOne(['user_id' => Yii::$app->user->id]);

        $comentarios = Comentarios::find()
            ->where(['turista_id' => $turista->id])->all();

        return $this->render('experienciasComentadas', [
            'comentarios' => $comentarios,
        ]);
    }

    public function actionReserva($id)
    {
        $experiencia = Experiencias::findOne($id);

        if (!$experiencia) {
            throw new NotFoundHttpException('Experiência não encontrada.');
        }

        $metodoPagamento = Metodopagamentos::find()->all();
        $reserva = new Reservas();

        $reserva->numPessoas = 1;

        if ($reserva->load(Yii::$app->request->post())) {

            $vagasDisponiveis = $experiencia->getVagasDisponiveis();

            if ($reserva->numPessoas > $vagasDisponiveis) {
                Yii::$app->session->setFlash('error', "Desculpe, apenas {$vagasDisponiveis} vagas disponíveis para esta experiência.");
                return $this->render('reserva', [
                    'experiencia' => $experiencia,
                    'metodoPagamento' => $metodoPagamento,
                    'reserva' => $reserva,
                ]);
            }

            //$user = Yii::$app->user->identity;

            // Buscar turista usando namespace completo
            $turista = Turistas::findOne(['user_id' => Yii::$app->user->id]);

            if (!$turista) {
                Yii::$app->session->setFlash('error', 'Perfil de turista não encontrado.');
                return $this->render('reserva', [
                    'experiencia' => $experiencia,
                    'metodoPagamento' => $metodoPagamento,
                    'reserva' => $reserva,
                ]);
            }

            $reserva->experiencia_id = $id;
            $reserva->turista_id = $turista->id;
            $reserva->dataReserva = date('Y-m-d H:i:s');
            $reserva->disponivel = 'sim';

            // DEBUG: Ver se está salvando
            if ($reserva->save()) {
                Yii::$app->session->setFlash('success', 'Reserva realizada com sucesso!');
                return $this->redirect(['site/confirmacao', 'id' => $reserva->id]);
            } else {
                // Mostrar os erros de validação
                $errors = $reserva->getErrors();
                Yii::$app->session->setFlash('error', 'Erro ao realizar reserva: ' . print_r($errors, true));

                return $this->render('reserva', [
                    'experiencia' => $experiencia,
                    'metodoPagamento' => $metodoPagamento,
                    'reserva' => $reserva,
                ]);
            }
        }

        return $this->render('reserva', [
            'experiencia' => $experiencia,
            'metodoPagamento' => $metodoPagamento,
            'reserva' => $reserva,
        ]);
    }

    public function actionConfirmacao($id)
    {
        $reserva = Reservas::findOne($id);

        if (!$reserva) {
            throw new NotFoundHttpException('Reserva não encontrada.');
        }

        // 1. Buscar o perfil do turista correspondente ao utilizador logado
        $turista = Turistas::findOne(['user_id' => Yii::$app->user->id]);

        // 2. Verificar se a reserva pertence a esse turista
        // Se o turista não existir ou se o ID não coincidir, bloqueia o acesso
        if (!$turista || $reserva->turista_id != $turista->id) {
            throw new \yii\web\ForbiddenHttpException('Não tem permissão para ver esta reserva.');
        }

        return $this->render('confirmacao', [
            'reserva' => $reserva,
        ]);
    }

    public function actionExperienciasReservadas()
    {
        // 1. Primeiro, encontramos o perfil do turista associado ao utilizador logado
        $turista = Turistas::findOne(['user_id' => Yii::$app->user->id]);

        // Se o utilizador não tiver um perfil de turista, retornamos uma lista vazia ou erro
        if (!$turista) {
            return $this->render('experienciasReservadas', [
                'reservas' => [],
            ]);
        }

        // 2. Buscamos todas as reservas filtrando pelo turista_id
        $reservas = Reservas::find()
            ->where(['turista_id' => $turista->id])
            ->orderBy(['dataReserva' => SORT_DESC]) // Opcional: mostrar as mais recentes primeiro
            ->all();

        return $this->render('experienciasReservadas', [
            'reservas' => $reservas,
        ]);
    }

    /**
     * Responder a um comentário (apenas para gestores da experiência)
     */
    public function actionResponderComentario($id)
    {
        $comentario = Comentarios::findOne($id);

        if (!$comentario) {
            throw new NotFoundHttpException('Comentário não encontrado.');
        }

        $experiencia = $comentario->experiencia;

        // Verificar se o utilizador logado é o gestor da experiência
        if (Yii::$app->user->isGuest || $experiencia->gestor->user_id != Yii::$app->user->id) {
            throw new \yii\web\ForbiddenHttpException('Apenas o gestor da experiência pode responder a comentários.');
        }

        if (Yii::$app->request->isPost) {
            $resposta = Yii::$app->request->post('resposta');

            if (!empty($resposta)) {
                $comentario->resposta = $resposta;
                $comentario->dataResposta = date('Y-m-d H:i:s');

                if ($comentario->save()) {
                    Yii::$app->session->setFlash('success', 'Resposta adicionada com sucesso!');
                } else {
                    Yii::$app->session->setFlash('error', 'Erro ao adicionar resposta.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'A resposta não pode estar vazia.');
            }
        }

        return $this->redirect(['site/detalhes', 'id' => $experiencia->id]);
    }

    /**
     * Editar resposta de um comentário
     */
    public function actionEditarResposta($id)
    {
        $comentario = Comentarios::findOne($id);

        if (!$comentario) {
            throw new NotFoundHttpException('Comentário não encontrado.');
        }

        $experiencia = $comentario->experiencia;

        // Verificar permissões
        if (Yii::$app->user->isGuest || $experiencia->gestor->user_id != Yii::$app->user->id) {
            throw new \yii\web\ForbiddenHttpException('Apenas o gestor da experiência pode editar respostas.');
        }

        if (Yii::$app->request->isPost) {
            $resposta = Yii::$app->request->post('resposta');

            if (!empty($resposta)) {
                $comentario->resposta = $resposta;
                $comentario->dataResposta = date('Y-m-d H:i:s');

                if ($comentario->save()) {
                    Yii::$app->session->setFlash('success', 'Resposta atualizada com sucesso!');
                } else {
                    Yii::$app->session->setFlash('error', 'Erro ao atualizar resposta.');
                }
            }
        }

        return $this->redirect(['site/detalhes', 'id' => $experiencia->id]);
    }

    /**
     * Remover resposta de um comentário
     */
    public function actionRemoverResposta($id)
    {
        $comentario = Comentarios::findOne($id);

        if (!$comentario) {
            throw new NotFoundHttpException('Comentário não encontrado.');
        }

        $experiencia = $comentario->experiencia;

        // Verificar permissões
        if (Yii::$app->user->isGuest || $experiencia->gestor->user_id != Yii::$app->user->id) {
            throw new \yii\web\ForbiddenHttpException('Apenas o gestor da experiência pode remover respostas.');
        }

        $comentario->resposta = null;
        $comentario->dataResposta = null;

        if ($comentario->save(false)) {
            Yii::$app->session->setFlash('success', 'Resposta removida com sucesso!');
        } else {
            Yii::$app->session->setFlash('error', 'Erro ao remover resposta.');
        }

        return $this->redirect(['site/detalhes', 'id' => $experiencia->id]);
    }

    public function actionComentarios()

    {
        // Verifica se o utilizador está autenticado
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        // Obtém o ID do user autenticado
        $userId = Yii::$app->user->id;

        // Busca o gestor associado ao user autenticado
        $gestor = Gestores::findOne(['user_id' => $userId]);

        if (!$gestor) {
            Yii::$app->session->setFlash('error', 'Gestor não encontrado.');
            return $this->redirect(['site/index']);
        }

        // Busca todos os comentários com resposta do gestor
        // através das experiências que pertencem a esse gestor
        $comentarios = Comentarios::find()
            ->joinWith(['experiencia'])
            ->where(['experiencias.gestor_id' => $gestor->id])
            ->andWhere(['IS NOT', 'comentarios.resposta', null])
            ->andWhere(['IS NOT', 'comentarios.dataResposta', null])
            ->orderBy(['comentarios.dataResposta' => SORT_DESC])
            ->all();

        return $this->render('comentarios', [
            'comentarios' => $comentarios,
        ]);
    }
}
