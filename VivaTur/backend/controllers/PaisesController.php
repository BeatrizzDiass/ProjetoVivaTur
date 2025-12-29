<?php

namespace backend\controllers;

use yii\web\Controller;

/**
 * Paises controller
 */
class PaisesController extends Controller
{
    /**
     * Lists all Paises models.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
