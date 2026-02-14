<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Avaliacoes;
use frontend\models\Turistas;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class AvaliacoesController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Criar nova avaliação
     */
    public function actionCreate($experiencia_id)
    {
        $turista = Turistas::findOne(['user_id' => Yii::$app->user->id]);
        
        if (!$turista) {
            Yii::$app->session->setFlash('error', 'Apenas turistas podem avaliar.');
            return $this->redirect(['experiencias/detalhes', 'id' => $experiencia_id]);
        }

        $model = new Avaliacoes();
        
        if ($model->load(Yii::$app->request->post())) {
            $model->experiencia_id = $experiencia_id;
            $model->user_id = Yii::$app->user->id;
            $model->turista_id = $turista->id;
            
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Avaliação adicionada com sucesso!');
            } else {
                Yii::$app->session->setFlash('error', 'Erro ao guardar avaliação.');
            }
        }
        
        return $this->redirect(['experiencias/detalhes', 'id' => $experiencia_id]);
    }

    /**
     * Editar avaliação (apenas o autor)
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $this->verificarAvaliacao($model);

        if (Yii::$app->request->isPost) {
            $estrela = Yii::$app->request->post('estrela');
            
            if (!empty($estrela) && $estrela >= 1 && $estrela <= 5) {
                $model->estrela = $estrela;
                
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Avaliação atualizada com sucesso!');
                } else {
                    Yii::$app->session->setFlash('error', 'Erro ao atualizar avaliação.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Por favor, selecione uma classificação válida (1-5 estrelas).');
            }
        }

        return $this->redirect(['experiencias/detalhes', 'id' => $model->experiencia_id]);
    }

    /**
     * Remover avaliação (apenas o autor)
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->verificarAvaliacao($model);
        
        $experienciaId = $model->experiencia_id;
        
        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Avaliação removida com sucesso!');
        } else {
            Yii::$app->session->setFlash('error', 'Erro ao remover avaliação.');
        }

        return $this->redirect(['experiencias/detalhes', 'id' => $experienciaId]);
    }

    /**
     * Procura a avaliação pelo ID
     */
    protected function findModel($id)
    {
        if (($model = Avaliacoes::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Avaliação não encontrada.');
    }

    /**
     * Verifica se o utilizador é o autor da avaliação
     */
    protected function verificarAvaliacao($model)
    {
        $turista = Turistas::findOne(['user_id' => Yii::$app->user->id]);
            
        if (!$turista || $model->turista_id != $turista->id) {
            throw new \yii\web\ForbiddenHttpException('Não tem permissão para esta ação.');
        }
    }

        public function actionExperienciasAvaliadas()
    {
        $turista = Turistas::findOne(['user_id' => Yii::$app->user->id]);

        $avaliacoes = [];
        if ($turista) {
            $avaliacoes = Avaliacoes::find()
                ->where(['turista_id' => $turista->id])
                ->all();
        }

        return $this->render('experienciasAvaliadas', [
            'avaliacoes' => $avaliacoes,
        ]);
    }
}