<?php
namespace backend\modules\api\controllers;

class ExperienciaController extends \yii\rest\ActiveController
{
    public $modelClass = 'common\models\Experiencias';


    //pesquisar experiencias com filtros (nome, categoria_id, pais_id)
    //URL: /api/experiencia/getexperienciasfiltradas?nome=xyz
    //URL: /api/experiencia/getexperienciasfiltradas?categoria_id=
    //URL: /api/experiencia/getexperienciasfiltradas?pais_id
    public function actionGetexperienciasfiltradas()
    {
        $experienciasmodel = $this->modelClass;
        $experienciasfiltradas = $experienciasmodel::find();

        // Apenas o ÚLTIMO filtro será aplicado
        if ($nome = \Yii::$app->request->get('nome')) {
            $experienciasfiltradas->where(['like', 'nome', $nome]);
        }

        if ($categoria_id = \Yii::$app->request->get('categoria_id')) {
            $experienciasfiltradas->where(['categoria_id' => $categoria_id]); // Substitui o anterior
        }

        if ($pais_id = \Yii::$app->request->get('pais_id')) {
            $experienciasfiltradas->where(['pais_id' => $pais_id]); // Substitui o anterior
        }

        return $experienciasfiltradas->all();
    }
}