<?php
namespace backend\modules\api\controllers;

class ComentarioController extends \yii\rest\ActiveController
{
    public $modelClass = 'common\models\Comentarios';


    //CRUD Comentarios
    //URL: api/comentario
    public function actionPostcomentarios()
    {
        $comentariosmodel = new $this->modelClass;

        $comentariosmodel->id = 0; // Defina como 0 para auto-incremento
        $comentariosmodel->descricao = \Yii::$app->request->post('descricao');
        $comentariosmodel->dataCriacao = \Yii::$app->request->post('dataCriacao');
        $comentariosmodel->experiencia_id = \Yii::$app->request->post('experiencia_id');
        $comentariosmodel->user_id = \Yii::$app->request->post('user_id');

        $comentariosmodel->save();
        return $comentariosmodel;


    }


    //Atualizar comentário
    //URL: api/comentario/{id}
    public function actionPutcomentario($id)
    {
        $novo_comentario =\Yii::$app->request->post('descricao');
        $comentariomodel = new $this->modelClass;
        $recs = $comentariomodel::findOne($id);
        if ($recs) {
            $recs->descricao = $novo_comentario;
            $recs->save();
        }
        else{
            throw new \yii\web\NotFoundHttpException('Comentário não encontrado.');
        }
    }


    //Apagar comentário
    //URL: api/comentario/{id}
    public function actionDelete($id)
    {
        $comentariomodel = new $this->modelClass;
        $recs = $comentariomodel::deleteAll(['id' => $id]);
        return $recs;
    }



    //CRUD Comentarios por experiencia
    //URL: api/comentario/experiencia/{experiencia_id}
    public function actionGetcomentariosexperiencia($experiencia_id)
    {
        $comentariosmodel = $this->modelClass;

        $comentarios = $comentariosmodel::find()
            ->where(['experiencia_id' => $experiencia_id])
            ->all();

        return $comentarios;
    }

    //Criar comentário para uma experiência
    //URL: api/comentario/experiencia/{experiencia_id}
    public function actionPostcomentariosexperiencia($experiencia_id)
    {
        $comentariosmodel = new $this->modelClass;

        // Preencher os campos do POST
        $comentariosmodel->descricao = \Yii::$app->request->post('descricao');
        $comentariosmodel->dataCriacao = \Yii::$app->request->post('dataCriacao');
        $comentariosmodel->experiencia_id = $experiencia_id;
        $comentariosmodel->user_id = \Yii::$app->request->post('user_id');

        $comentariosmodel->save();
        return $comentariosmodel;
        
    }

    //Atualizar comentário de uma experiência
    //URL: api/comentario/experiencia/{experiencia_id}/{id}
    public function actionPutcomentariosexperiencia($experiencia_id, $id)
    {
        $novo_comentario =\Yii::$app->request->post('descricao');
        $comentariomodel = new $this->modelClass;
        $recs = $comentariomodel::findOne(['id' => $id, 'experiencia_id' => $experiencia_id]);
        if ($recs) {
            $recs->descricao = $novo_comentario;
            $recs->save();
        }
        else{
            throw new \yii\web\NotFoundHttpException('Comentário não encontrado para a experiência especificada.');
        }
    }


    //Apagar comentário de uma experiência
    //URL: api/comentario/experiencia/{experiencia_id}/{id}
    public function actionDeletecomentariosexperiencia($experiencia_id, $id)
    {
        $comentariomodel = new $this->modelClass;
        $recs = $comentariomodel::deleteAll(['id' => $id, 'experiencia_id' => $experiencia_id]);
        return $recs;
    }




}