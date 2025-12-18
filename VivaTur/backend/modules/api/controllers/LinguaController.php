<?php
namespace backend\modules\api\controllers;
class LinguaController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\Linguas';



    //pesquisar lingua pelo nome 
    //URL: api/categorias/nome/{nome}
    public function actionPesquisarpornome($nomelingua)
    {
        $linguamodels = $this->modelClass;
        $linguas = $linguamodels::find()
            ->where(['nomelingua' => $nomelingua])
            ->all();

        return $linguas;
    }

}