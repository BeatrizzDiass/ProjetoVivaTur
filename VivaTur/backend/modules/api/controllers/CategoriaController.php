<?php
namespace backend\modules\api\controllers;

use yii\rest\ActiveController;

class CategoriaController extends ActiveController
{
    public $modelClass = 'common\models\Categorias';

    // Pesquisar categorias pelo nome
    //URL: api/categorias/nome/{nome}
    public function actionPesquisarpornome($nomecategoria)
    {
        $categoriasmodel = $this->modelClass;
        $result = $categoriasmodel::find()->where(['nome' => $nomecategoria])->all();
        
        return $result;
    }
}