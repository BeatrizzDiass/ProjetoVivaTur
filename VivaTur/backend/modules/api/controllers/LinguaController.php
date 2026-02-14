<?php
namespace backend\modules\api\controllers;
use yii\filters\auth\QueryParamAuth;

class LinguaController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\Linguas';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::class,
        ];

        return $behaviors;
    }


    //pesquisar lingua pelo nome 
    //URL: api/categorias/nome/{nome}
    public function actionPesquisarpornome($nomelingua)
    {
        $linguamodels = $this->modelClass;
        $linguas = $linguamodels::find()
            ->where(['nome' => $nomelingua])
            ->all();

        return $linguas;
    }

}