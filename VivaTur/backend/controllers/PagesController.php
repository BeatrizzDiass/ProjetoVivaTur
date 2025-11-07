<?php

namespace backend\controllers;

use yii\web\Controller;

class PagesController extends Controller
{
    public function actionWidgets()
    {
        $this->view->title = 'Widgets';
        return $this->render('widgets');
    }
}
