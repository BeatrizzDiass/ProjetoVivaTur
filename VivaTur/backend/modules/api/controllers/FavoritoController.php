<?php
namespace backend\modules\api\controllers;

use yii\filters\auth\QueryParamAuth;

class FavoritoController extends \yii\rest\ActiveController
{
    public $modelClass = 'common\models\Favoritos';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::class,
            // 'only' => ['index'],
        ];

        return $behaviors;
    }

    // Adicionar uma nova experiência aos favoritos
    //backend/web/api/favoritos
    //URL: 
    public function actionPostfavorito()
    {
        $favoritomodel = $this->modelClass;

        $favoritomodel->id = 0; // Defina como 0 para auto-incremento
        $favoritomodel->experiencia_id = \Yii::$app->request->post('experiencia_id');
        $favoritomodel->user_id = \Yii::$app->request->post('user_id');
        $favoritomodel->turista_id = \Yii::$app->request->post('turista_id');

        $favoritomodel->save();
        return $favoritomodel;

    }



    // Remover uma experiência dos favoritos
    //URL: DELETE /api/favoritos/{id}
    public function actionDelete($id)
    {
        $favoritomodel = new $this->modelClass;
        $recs = $favoritomodel::deleteAll(['id' => $id]);
        return $recs;
    }

}