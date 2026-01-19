<?php
namespace backend\modules\api\controllers;
use yii\filters\auth\QueryParamAuth;

class MetodopagamentoController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\Metodopagamentos';


    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::class,
            'except' => ['index', 'view'],
        ];

        return $behaviors;
    }

    //pesquisar metodos de pagamento pelo nome 
    //URL: api/metodopagamentos/nome/{nome}
    public function actionPesquisarpornome($metodopagamento)
    {
        $metodomodel = $this->modelClass;
        $metodopagamento = $metodomodel::find()
        ->where(['nome' => $metodopagamento])
        ->all();
        return $metodopagamento;
    }
}