<?php
namespace backend\modules\api\controllers;
class MetodopagamentoController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\Metodopagamentos';



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