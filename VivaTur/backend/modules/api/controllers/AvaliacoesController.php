<?php
namespace backend\modules\api\controllers;

class AvaliacoesController extends \yii\rest\ActiveController
{
    public $modelClass = 'common\models\Avaliacoes';

    // CRUD para Avaliacoes
    //URL: /api/avaliacoes
    public function actionPostavaliacoes()
    {
        $avaliacoesmodel = new $this->modelClass;

        $avaliacoesmodel->id = 0; // Defina como 0 para auto-incremento
        $avaliacoesmodel->estrela = \Yii::$app->request->post('estrela');
        $avaliacoesmodel->experiencia_id = \Yii::$app->request->post('experiencia_id');

        $avaliacoesmodel->save();
        return $avaliacoesmodel;
    }

    // Atualizar avaliação por ID
    //URL: /api/avaliacoes
    public function actionPutavaliacoes($id)
    {

        $nova_estrela =\Yii::$app->request->post('estrela');
        $avaliacaomodel = new $this->modelClass;
        $recs = $avaliacaomodel::findOne($id);
        if ($recs) {
            $recs->estrela = $nova_estrela;
            $recs->save();
        }
        else{
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


    // CRUD para Avaliacoes por Experiencia
    //URL: api/avaliacoes/experiencias/{id_experiencia}/avaliacoes
    public function actionGetavaliacoesexperiencia($experiencia_id)
    {
        $avaliacoesmodel = $this->modelClass;

        $avaliacoes = $avaliacoesmodel::find()
            ->where(['experiencia_id' => $experiencia_id])
            ->all();

        return $avaliacoes;
    }

    // Criar avaliação para uma experiência específica
    //URL: api/avaliacoes/experiencias/{id_experiencia}/avaliacoes
    public function actionPostavaliacoesexperiencia($experiencia_id)
    {
        $avaliacoesmodel = new $this->modelClass;

        $avaliacoesmodel->id = 0; // Defina como 0 para auto-incremento
        $avaliacoesmodel->estrela = \Yii::$app->request->post('estrela');
        $avaliacoesmodel->experiencia_id = $experiencia_id;
        $avaliacoesmodel->save();
        return $avaliacoesmodel;

    }

    // Atualizar avaliação específica para uma experiência
    //URL: api/avaliacoes/experiencias/{id_experiencia}/avaliacoes/{id}
    public function actionPutavaliacoesexperiencia($experiencia_id, $id)
    {
        $nova_estrela =\Yii::$app->request->post('estrela');
        $avaliacaomodel = new $this->modelClass;
        $recs = $avaliacaomodel::findOne(['id' => $id, 'experiencia_id' => $experiencia_id]);
        if ($recs) {
            $recs->estrela = $nova_estrela;
            $recs->save();
        }
        else{
            throw new \yii\web\NotFoundHttpException('Avaliação não encontrada para a experiência especificada.');
        }
    }


    // Apagar avaliação específica para uma experiência
    //URL: api/avaliacoes/experiencias/{id_experiencia}/avaliacoes/{id}
    public function actionDeleteavaliacoesexperiencia($experiencia_id, $id)
    {
        $avaliacaomodel = new $this->modelClass;
        $recs = $avaliacaomodel::deleteAll(['id' => $id, 'experiencia_id' => $experiencia_id]);
        return $recs;
    }
}