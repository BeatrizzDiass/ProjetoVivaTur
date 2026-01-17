<?php
namespace backend\modules\api\controllers;

use yii\rest\ActiveController;
use common\models\Gestor;

class GestorController extends ActiveController
{
    public $modelClass = 'common\models\Gestores';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // Autenticação (se necessário)
        $behaviors['authenticator'] = [
            'class' => \yii\filters\auth\QueryParamAuth::class,
        ];

        return $behaviors;
    }
}