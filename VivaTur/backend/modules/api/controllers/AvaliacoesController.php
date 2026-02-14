<?php
namespace backend\modules\api\controllers;

use yii\filters\auth\QueryParamAuth;

class AvaliacoesController extends \yii\rest\ActiveController
{
    public $modelClass = 'common\models\Avaliacoes';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => \yii\filters\auth\QueryParamAuth::class,
            'tokenParam' => 'access-token',
            'except' => ['*'],
        ];

        return $behaviors;
    }

    // CRUD para Avaliações
    //URL: /api/avaliacoes
    public function actionPostavaliacoes()
    {
        $avaliacoesmodel = new $this->modelClass;

        $avaliacoesmodel->id = 0; // Auto-incremento
        $avaliacoesmodel->estrela = \Yii::$app->request->post('estrela');
        $avaliacoesmodel->experiencia_id = \Yii::$app->request->post('experiencia_id');
        $avaliacoesmodel->user_id = \Yii::$app->request->post('user_id');
        $avaliacoesmodel->turista_id = \Yii::$app->request->post('turista_id');

        if (!$avaliacoesmodel->save()) {
            return $avaliacoesmodel->errors;
        }
        return $avaliacoesmodel;
    }

    // Atualizar avaliação por ID
    //URL: /api/avaliacoes/{id}
    public function actionPutavaliacoes($id)
    {
        $nova_estrela = \Yii::$app->request->post('estrela');
        $avaliacaomodel = new $this->modelClass;
        $recs = $avaliacaomodel::findOne($id);
        if ($recs) {
            $recs->estrela = $nova_estrela;
            if (!$recs->save()) {
                return $recs->errors;
            }
            return $recs;
        } else {
            throw new \yii\web\NotFoundHttpException('Avaliação não encontrada.');
        }
    }

    // Apagar avaliação por ID
    //URL: /api/avaliacoes/{id}
    public function actionDelete($id)
    {
        $avaliacaoModel = new $this->modelClass;
        $recs = $avaliacaoModel::deleteAll(['id' => $id]);
        return $recs;
    }

    //URL: /api/avaliacoes/user/{user_id}
    public function actionGetavaliacoesuser($user_id)
    {
        $avaliacoesmodel = $this->modelClass;

        $avaliacoes = $avaliacoesmodel::find()
            ->where(['user_id' => $user_id])
            ->orderBy(['id' => SORT_DESC])
            ->all();

        return $avaliacoes;
    }

    // CRUD para avaliações por Experiencia
    //URL: /api/avaliacoes/experiencias/{experiencia_id}/avaliacoes
    public function actionGetavaliacoesexperiencia($experiencia_id)
    {
        $avaliacoesmodel = $this->modelClass;

        $avaliacoes = $avaliacoesmodel::find()
            ->where(['experiencia_id' => $experiencia_id])
            ->all();

        return $avaliacoes;
    }

    // Criar avaliação para uma experiência específica
    //URL: api/avaliacoes/experiencias/{experiencia_id}/avaliacoes
    public function actionPostavaliacoesexperiencia($experiencia_id)
    {
        $avaliacoesmodel = new $this->modelClass;

        $avaliacoesmodel->id = 0; // Auto-incremento
        $avaliacoesmodel->estrela = \Yii::$app->request->post('estrela');
        $avaliacoesmodel->experiencia_id = $experiencia_id;
        $avaliacoesmodel->user_id = \Yii::$app->request->post('user_id');
        $avaliacoesmodel->turista_id = \Yii::$app->request->post('turista_id');

        if (!$avaliacoesmodel->save()) {
            \Yii::$app->response->statusCode = 400;
            return [
                'success' => false,
                'errors' => $avaliacoesmodel->errors
            ];
        }
        return $avaliacoesmodel;
    }

    // Atualizar avaliação específica para uma experiência
    //URL: api/avaliacoes/experiencias/{experiencia_id}/avaliacoes/{id}
    public function actionPutavaliacoesexperiencia($experiencia_id, $id)
    {
        $nova_estrela = \Yii::$app->request->post('estrela');
        $avaliacaomodel = new $this->modelClass;
        $recs = $avaliacaomodel::findOne(['id' => $id, 'experiencia_id' => $experiencia_id]);
        if ($recs) {
            $recs->estrela = $nova_estrela;
            if (!$recs->save()) {
                \Yii::$app->response->statusCode = 400;
                return [
                    'success' => false,
                    'errors' => $recs->errors
                ];
            }
            return $recs;
        } else {
            throw new \yii\web\NotFoundHttpException('Avaliação não encontrada para a experiência especificada.');
        }
    }

    // Apagar avaliação específica para uma experiência
    //URL: api/avaliacoes/experiencias/{experiencia_id}/avaliacoes/{id}
    public function actionDeleteavaliacoesexperiencia($experiencia_id, $id)
    {
        $avaliacaomodel = new $this->modelClass;
        $recs = $avaliacaomodel::deleteAll(['id' => $id, 'experiencia_id' => $experiencia_id]);
        return $recs;
    }
}