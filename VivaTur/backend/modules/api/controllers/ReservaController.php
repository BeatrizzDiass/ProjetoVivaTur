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

        // ✅ CONFIGURAÇÃO CORRETA
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
            'tokenParam' => 'access-token', // ← COM HÍFEN, não underscore!
        ];

        // OU, se quiser desabilitar autenticação temporariamente para testar:
        // unset($behaviors['authenticator']);

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

        // Receber dados do POST
        $data = Yii::$app->request->post();

        // Log para debug
        Yii::info('Dados recebidos: ' . json_encode($data), 'reserva-create');

        // IMPORTANTE: Usar '' como segundo parâmetro para carregar sem prefixo
        if ($model->load($data, '')) {
            if ($model->save()) {
                Yii::info('Reserva criada com sucesso: ID ' . $model->id, 'reserva-create');
                return $model;
            } else {
                // Log dos erros
                Yii::error('Erros de validação: ' . json_encode($model->errors), 'reserva-create');
                throw new \yii\web\ServerErrorHttpException(json_encode($model->errors));
            }
        }

        Yii::error('Load falhou. Dados recebidos: ' . json_encode($data), 'reserva-create');
        throw new \yii\web\BadRequestHttpException('Não foi possível carregar os dados');
    }
}