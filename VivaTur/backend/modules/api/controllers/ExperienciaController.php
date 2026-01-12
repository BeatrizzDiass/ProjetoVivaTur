<?php
namespace backend\modules\api\controllers;

use Yii;
use yii\filters\auth\QueryParamAuth;

class ExperienciaController extends \yii\rest\ActiveController
{
    public $modelClass = 'common\models\Experiencias';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::class,
            'except' => ['index', 'view', 'getexperienciasfiltradas'], // Estas ações são públicas
        ];

        return $behaviors;
    }


    // GET /api/experiencia/getexperienciasfiltradas
    // Exemplos:
    // ?nome=surf
    // ?categoria_id=3
    // ?pais_id=1
    // ?nome=surf&categoria_id=3&pais_id=1 (combinados!)
    public function actionGetexperienciasfiltradas()
    {
        $modelClass = $this->modelClass;
        $query = $modelClass::find();

        // andFilterWhere ignora valores vazios/null automaticamente
        $query->andFilterWhere(['like', 'nome', Yii::$app->request->get('nome')])
            ->andFilterWhere(['categoria_id' => Yii::$app->request->get('categoria_id')])
            ->andFilterWhere(['pais_id' => Yii::$app->request->get('pais_id')]);

        return $query->all();
    }
}