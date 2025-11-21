<?php

namespace backend\controllers;

use app\models\Comentario;
use app\models\ComentarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ComentarioController implements the CRUD actions for Comentario model.
 */
class ComentarioController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Comentario models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ComentarioSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Comentario model.
     * @param int $id ID
     * @param string $descricao Descricao
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $descricao)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $descricao),
        ]);
    }

    /**
     * Creates a new Comentario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Comentario();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id, 'descricao' => $model->descricao]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Comentario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @param string $descricao Descricao
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $descricao)
    {
        $model = $this->findModel($id, $descricao);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'descricao' => $model->descricao]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Comentario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @param string $descricao Descricao
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $descricao)
    {
        $this->findModel($id, $descricao)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Comentario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @param string $descricao Descricao
     * @return Comentario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $descricao)
    {
        if (($model = Comentario::findOne(['id' => $id, 'descricao' => $descricao])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
