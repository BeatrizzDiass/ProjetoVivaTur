<?php
namespace backend\modules\api\controllers;

use common\models\Reservas;
use common\models\Experiencias;
use Yii;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\web\Response;
use yii\filters\Cors;

class ReservaController extends ActiveController
{
    public $modelClass = 'common\models\Reservas';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
            'except' => ['*'], // Permite acesso sem autenticação
        ];

        return $behaviors;
    }
    
    //criar nova reserva
    //URL: api/reserva/postreserva
    public function actionPostreserva()
    {
        $reservamodel = new $this->modelClass;

        $reservamodel->id = 0;
        $reservamodel->user_id = \Yii::$app->request->post('user_id');
        $reservamodel->experiencia_id = \Yii::$app->request->post('experiencia_id');
        $reservamodel->metodoPagamento_id = \Yii::$app->request->post('metodoPagamento_id');
        $reservamodel->dataReserva = \Yii::$app->request->post('dataReserva');
        $reservamodel->disponivel = \Yii::$app->request->post('disponivel');
        $reservamodel->turista_id = \Yii::$app->request->post('turista_id');
        $reservamodel->numPessoas = \Yii::$app->request->post('numPessoas');

        $reservamodel->save();
        return $reservamodel;
    }

    //Buscar reservas por experiência
    //URL: api/reserva/experiencia/{id}
    public function actionExperiencia($id)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $reservas = Reservas::find()
            ->where(['experiencia_id' => $id])
            ->all();

        return $reservas;
    }

    //Apagar reserva pelo id
    //URL: api/reserva/{id}
    public function actionDelete($id)
    {
        $reservamodel = new $this->modelClass;
        $recs = $reservamodel::deleteAll(['id' => $id]);
        return $recs;
    }

    public function actionCreate()
    {
        $model = new Reservas();

        $data = Yii::$app->request->post();

        if ($model->load($data, '')) {
            if ($model->save()) {
                return $model;
            } else {
                throw new \yii\web\ServerErrorHttpException(json_encode($model->errors));
            }
        }

        throw new \yii\web\BadRequestHttpException('Não foi possível carregar os dados');
    }

    public function actionGetreservasuser($user_id)
    {
        $reservamodel = $this->modelClass;

        $reservas = $reservamodel::find()
            ->where(['user_id' => $user_id])
            ->all();

        return $reservas;
    }
}