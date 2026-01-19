<?php
namespace backend\modules\api\controllers;

use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;

class TuristasController extends ActiveController
{
    public $modelClass = 'common\models\Turistas';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::class,
            'except' => ['*'],
        ];

        return $behaviors;
    }
}