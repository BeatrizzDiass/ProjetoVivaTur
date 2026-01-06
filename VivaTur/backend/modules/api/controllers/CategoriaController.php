<?php
namespace backend\modules\api\controllers;

use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;

class CategoriaController extends ActiveController
{
    public $modelClass = 'common\models\Categorias';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::class,
            // 'only' => ['index'], // se quiseres só proteger alguns métodos
        ];

        return $behaviors;
    }


    // Pesquisar categorias pelo nome
    //URL: api/categorias/nome/{nome}
    public function actionPesquisarpornome($nomecategoria)
    {
        $categoriasmodel = $this->modelClass;
        $result = $categoriasmodel::find()->where(['nome' => $nomecategoria])->all();
        
        return $result;
    }
}