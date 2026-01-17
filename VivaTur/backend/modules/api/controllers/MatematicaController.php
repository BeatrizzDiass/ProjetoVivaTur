<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;

class MatematicaController extends ActiveController
{

    public $modelClass = 'common\models\Categorias';


    public function actionPesquisarpornome($nomecategoria)
    {
        $categoriasmodel = $this->modelClass;
        $result = $categoriasmodel::find()->where(['nome' => $nomecategoria])->all();

        return $result;
    }

    public function actionRaizdois(){

       $response = 'raizdois => 1.41';

        return $response;

    }

}