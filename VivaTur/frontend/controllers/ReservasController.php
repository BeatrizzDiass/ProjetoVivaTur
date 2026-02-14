<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Reservas;
use frontend\models\Turistas;
use frontend\models\Experiencias;
use frontend\models\Metodopagamentos;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

class ReservasController extends Controller
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
     * Criar nova reserva
     */
    public function actionCreate($experiencia_id)
    {
        $experiencia = Experiencias::findOne($experiencia_id);
        
        if (!$experiencia) {
            throw new NotFoundHttpException('Experiência não encontrada.');
        }

        $metodoPagamento = Metodopagamentos::find()->all();
        $model = new Reservas();
        $model->numPessoas = 1;

        if ($model->load(Yii::$app->request->post())) {
            $vagasDisponiveis = $experiencia->getVagasDisponiveis();

            if ($model->numPessoas > $vagasDisponiveis) {
                Yii::$app->session->setFlash('error', "Apenas {$vagasDisponiveis} vagas disponíveis.");
                return $this->render('reserva', [
                    'experiencia' => $experiencia,
                    'metodoPagamento' => $metodoPagamento,
                    'model' => $model,
                ]);
            }

            $turista = Turistas::findOne(['user_id' => Yii::$app->user->id]);

            if (!$turista) {
                Yii::$app->session->setFlash('error', 'Perfil de turista não encontrado.');
                return $this->render('reserva', [
                    'experiencia' => $experiencia,
                    'metodoPagamento' => $metodoPagamento,
                    'model' => $model,
                ]);
            }

            $model->experiencia_id = $experiencia_id;
            $model->user_id = Yii::$app->user->id;
            $model->turista_id = $turista->id;
            $model->dataReserva = date('Y-m-d H:i:s');
            $model->disponivel = 'sim';

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Reserva realizada com sucesso!');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                $errors = $model->getErrors();
                Yii::$app->session->setFlash('error', 'Erro ao realizar reserva: ' . print_r($errors, true));
            }
        }

        return $this->render('reserva', [
            'experiencia' => $experiencia,
            'metodoPagamento' => $metodoPagamento,
            'model' => $model,
        ]);
    }

    /**
     * Ver detalhes da reserva (confirmação)
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $this->verificarReserva($model);

        return $this->render('confirmacao', [
            'model' => $model,
        ]);
    }

    /**
     * Listar todas as reservas do utilizador
     */
    public function actionIndex()
    {
        $turista = Turistas::findOne(['user_id' => Yii::$app->user->id]);

        $models = [];
        if ($turista) {
            $models = Reservas::find()
                ->where(['turista_id' => $turista->id])
                ->orderBy(['dataReserva' => SORT_DESC])
                ->all();
        }

        return $this->render('reserva', [
            'models' => $models,
        ]);
    }

    /**
     * Procura a reserva pelo ID
     */
    protected function findModel($id)
    {
        if (($model = Reservas::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Reserva não encontrada.');
    }

    /**
     * Verifica se a reserva pertence ao utilizador logado
     */
    protected function verificarReserva($model)
    {
        $turista = Turistas::findOne(['user_id' => Yii::$app->user->id]);
        
        if (!$turista || $model->turista_id != $turista->id) {
            throw new \yii\web\ForbiddenHttpException('Não tem permissão para ver esta reserva.');
        }
    }

        public function actionExperienciasReservadas()
    {
        $turista = Turistas::findOne(['user_id' => Yii::$app->user->id]);

        if (!$turista) {
            return $this->render('experienciasReservadas', [
                'reservas' => [],
            ]);
        }

        $reservas = Reservas::find()
            ->where(['turista_id' => $turista->id])
            ->orderBy(['dataReserva' => SORT_DESC])
            ->all();

        return $this->render('experienciasReservadas', [
            'reservas' => $reservas,
        ]);
    }
}