<?php
namespace backend\modules\api\controllers;
use yii\filters\auth\QueryParamAuth;

class PaisesController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\Paises';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::class,
            'except' => ['index', 'view'], // Permite acesso sem autenticação
        ];

        return $behaviors;
    }

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