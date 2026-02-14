<?php
namespace frontend\controllers;

use Yii;
use frontend\models\Comentarios;
use frontend\models\Turistas;
use frontend\models\Gestores;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class ComentariosController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['create', 'update', 'delete', 'responder', 'editar-resposta', 'remover-resposta'],
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
                    'remover-resposta' => ['post'],
                ],
            ],
        ];
    }

    public function actionCreate($experiencia_id)
    {
        $turista = Turistas::findOne(['user_id' => Yii::$app->user->id]);

        if (!$turista) {
            Yii::$app->session->setFlash('error', 'Apenas turistas podem comentar.');
            return $this->redirect(['experiencias/detalhes', 'id' => $experiencia_id]);
        }

        $model = new Comentarios();

        if ($model->load(Yii::$app->request->post())) {
            $model->experiencia_id = $experiencia_id;
            $model->user_id = Yii::$app->user->id;
            $model->turista_id = $turista->id;
            $model->dataCriacao = date('Y-m-d H:i:s');

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Comentário adicionado com sucesso!');
            } else {
                Yii::$app->session->setFlash('error', 'Erro ao guardar comentário.');
            }
        }

        return $this->redirect(['experiencias/detalhes', 'id' => $experiencia_id]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $this->checkOwnership($model);

        if (Yii::$app->request->isPost) {
            $descricao = Yii::$app->request->post('descricao');

            if (!empty($descricao)) {
                $model->descricao = $descricao;

                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Comentário atualizado com sucesso!');
                } else {
                    Yii::$app->session->setFlash('error', 'Erro ao atualizar comentário.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'O comentário não pode estar vazio.');
            }
        }

        return $this->redirect(['experiencias/detalhes', 'id' => $model->experiencia_id]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->checkOwnership($model);

        $experienciaId = $model->experiencia_id;

        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Comentário removido com sucesso!');
        } else {
            Yii::$app->session->setFlash('error', 'Erro ao remover comentário.');
        }

        return $this->redirect(['experiencias/detalhes', 'id' => $experienciaId]);
    }

    /**
     * Responder a um comentário (apenas gestor)
     */
    public function actionResponder($id)
    {
        $model = $this->findModel($id);
        $this->checkGestorPermission($model);

        if (Yii::$app->request->isPost) {
            $resposta = Yii::$app->request->post('resposta');

            if (!empty($resposta)) {
                $model->resposta = $resposta;
                $model->dataResposta = date('Y-m-d H:i:s');

                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Resposta adicionada com sucesso!');
                } else {
                    Yii::$app->session->setFlash('error', 'Erro ao adicionar resposta.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'A resposta não pode estar vazia.');
            }
        }

        return $this->redirect(['experiencias/detalhes', 'id' => $model->experiencia_id]);
    }

    /**
     * Editar resposta (apenas gestor)
     */
    public function actionEditarResposta($id)
    {
        $model = $this->findModel($id);
        $this->checkGestorPermission($model);

        if (Yii::$app->request->isPost) {
            $resposta = Yii::$app->request->post('resposta');

            if (!empty($resposta)) {
                $model->resposta = $resposta;
                $model->dataResposta = date('Y-m-d H:i:s');

                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Resposta atualizada com sucesso!');
                } else {
                    Yii::$app->session->setFlash('error', 'Erro ao atualizar resposta.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'A resposta não pode estar vazia.');
            }
        }

        return $this->redirect(['experiencias/detalhes', 'id' => $model->experiencia_id]);
    }

    /**
     * Remover resposta (apenas gestor)
     */
    public function actionRemoverResposta($id)
    {
        $model = $this->findModel($id);
        $this->checkGestorPermission($model);

        $model->resposta = null;
        $model->dataResposta = null;

        if ($model->save(false)) {
            Yii::$app->session->setFlash('success', 'Resposta removida com sucesso!');
        } else {
            Yii::$app->session->setFlash('error', 'Erro ao remover resposta.');
        }

        return $this->redirect(['experiencias/detalhes', 'id' => $model->experiencia_id]);
    }

    /**
     * Procura o comentário pelo ID
     */
    protected function findModel($id)
    {
        if (($model = Comentarios::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Comentário não encontrado.');
    }

    /**
     * Verifica se o utilizador é o autor do comentário
     */
    protected function checkOwnership($model)
    {
        $turista = Turistas::findOne(['user_id' => Yii::$app->user->id]);

        if (!$turista || $model->turista_id != $turista->id) {
            throw new \yii\web\ForbiddenHttpException('Não tem permissão para esta ação.');
        }
    }

    /**
     * Verifica se o utilizador é o gestor da experiência
     */
    protected function checkGestorPermission($model)
    {
        $gestor = Gestores::findOne(['user_id' => Yii::$app->user->id]);

        if (!$gestor || $model->experiencia->gestor_id != $gestor->id) {
            throw new \yii\web\ForbiddenHttpException('Apenas o gestor da experiência pode responder a comentários.');
        }
    }

    /**
     * Lista experiências comentadas pelo turista
     */
    public function actionExperienciasComentadas()
    {
        $turista = Turistas::findOne(['user_id' => Yii::$app->user->id]);

        $comentarios = [];
        if ($turista) {
            $comentarios = Comentarios::find()
                ->where(['turista_id' => $turista->id])
                ->all();
        }

        return $this->render('experienciasComentadas', [
            'comentarios' => $comentarios,
        ]);
    }

    /**
     * Lista comentários com respostas do gestor
     */
    public function actionComentarios()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $userId = Yii::$app->user->id;
        $gestor = Gestores::findOne(['user_id' => $userId]);

        $comentarios = [];
        if ($gestor) {
            $comentarios = Comentarios::find()
                ->joinWith(['experiencia'])
                ->where(['experiencias.gestor_id' => $gestor->id])
                ->andWhere(['IS NOT', 'comentarios.resposta', null])
                ->andWhere(['IS NOT', 'comentarios.dataResposta', null])
                ->orderBy(['comentarios.dataResposta' => SORT_DESC])
                ->all();
        } else {
            Yii::$app->session->setFlash('error', 'Gestor não encontrado.');
            return $this->redirect(['site/index']);
        }

        return $this->render('comentarios', [
            'comentarios' => $comentarios,
        ]);
    }
}