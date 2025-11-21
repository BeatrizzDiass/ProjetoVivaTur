<?php

namespace backend\controllers;

use app\models\Pais;
use app\models\PaisSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PaisController implements the CRUD actions for Pais model.
 */
class PaisController extends Controller
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
	 * Lists all Pais models.
	 *
	 * @return string
	 */
	public function actionIndex()
	{
		$searchModel = new PaisSearch();
		$dataProvider = $searchModel->search($this->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Pais model.
	 * @param int $pais ID
	 * @return string
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionView($pais)
	{
		return $this->render('view', [
			'model' => $this->findModel($pais),
		]);
	}

	/**
	 * Creates a new Pais model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return string|\yii\web\Response
	 */
	public function actionCreate() // A ação 'create' não precisa de alterações
	{
		$model = new Pais();

		if ($this->request->isPost) {
			if ($model->load($this->request->post()) && $model->save()) {
				return $this->redirect(['view', 'pais' => $model->id]);
			}
		} else {
			$model->loadDefaultValues();
		}

		return $this->render('create', [
			'model' => $model,
		]);
	}

	/**
	 * Updates an existing Pais model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param int $pais ID
	 * @return string|\yii\web\Response
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionUpdate($pais)
	{
		$model = $this->findModel($pais);

		if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
			return $this->redirect(['view', 'pais' => $model->id]);
		}

		return $this->render('update', [
			'model' => $model,
		]);
	}

	/**
	 * Deletes an existing Pais model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param int $pais ID
	 * @return \yii\web\Response
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionDelete($pais)
	{
		$this->findModel($pais)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the Pais model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param int $pais ID
	 * @return Pais the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($pais)
	{
		if (($model = Pais::findOne(['id' => $pais])) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The requested page does not exist.');
		}
}