<?php
namespace app\modules\api\controllers;
use yii\filters\auth\QueryParamAuth;

class TuristasController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\Turistas';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::class,
            'except' => ['*'], // Permite acesso sem autenticação
        ];

        return $behaviors;
    }

}