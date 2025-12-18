<?php
namespace backend\modules\api\controllers;

use common\models\Reservas;
use common\models\Experiencias;
use yii\rest\ActiveController;
use yii\web\Response;
use yii\filters\Cors;

class ReservaController extends ActiveController
{
    public $modelClass = 'common\models\Reservas';


    //criar nova reserva
    //URL: api/reservas
    public function actionPostreserva()
    {

        $reservamodel = new $this->modelClass;

        $reservamodel->id = 0; // Defina como 0 para auto-incremento
        $reservamodel->user_id = \Yii::$app->request->post('user_id');
        $reservamodel->experiencia_id = \Yii::$app->request->post('experiencia_id');
        $reservamodel->metodoPagamento_id = \Yii::$app->request->post('metodoPagamento_id');
        $reservamodel->dataReserva = \Yii::$app->request->post('dataReserva');
        $reservamodel->disponivel = \Yii::$app->request->post('disponivel');

        $reservamodel->save();
        return $reservamodel;
    }



    //Apagar reserva pelo id
    //URL: api/reservas/{id}
    public function actionDelete($id)
    {
        $reservamodel = new $this->modelClass;
        $recs = $reservamodel::deleteAll(['id' => $id]);
        return $recs;
    }

}