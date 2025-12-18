<?php
namespace backend\modules\api\controllers;
class PaisesController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\Paises';


    //pesquisar pais pelo nome 
    //URL: api/paises/nome/{nome}
    public function actionPesquisarpornome($nomepais)
    {
        $paisesmodel = $this->modelClass;
        $pais = $paisesmodel::find()
            ->where(['nome' => $nomepais])
            ->all();
        return $pais;
    }
}