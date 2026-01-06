<?php

namespace backend\controllers;

use app\models\UploadForm;
use backend\models\Experiencias;
use app\models\ExperienciasSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ExperienciasController implements the CRUD actions for Experiencias model.
 */
class ExperienciasController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'denyCallback' => function () {
                    throw new \yii\web\ForbiddenHttpException(
                        'Não tem permissões para aceder a esta funcionalidade.'
                    );
                },
                'rules' => [
                    // Visualizar (todos os autenticados, incluindo turista)
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                        'roles' => ['viewExperiencias'],
                    ],

                    // Criar (admin e gestor)
                    [
                        'allow' => true,
                        'actions' => ['create', 'upload'],  // ← upload incluído aqui
                        'roles' => ['createExperiencias'],
                    ],

                    // Atualizar (admin atualiza tudo, gestor só as suas)
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['updateExperiencias'],
                        'roleParams' => function() {
                            return ['model' => $this->findModel(
                                \Yii::$app->request->get('id')
                            )];
                        },
                    ],

                    // Eliminar (admin elimina tudo, gestor só as suas)
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['deleteExperiencias'],
                        'roleParams' => function() {
                            return ['model' => $this->findModel(
                                \Yii::$app->request->get('id')
                            )];
                        },
                    ],
                ],
            ],

            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Experiencias models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ExperienciasSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $model = new Experiencias();

        if (Yii::$app->request->isPost) {

            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            if ($model->validate()) {

                $nome = uniqid() . '.' . $model->imageFile->extension;

                $model->imageFile->saveAs(
                    Yii::getAlias('@webroot/uploads/') . $nome
                );

                $model->imagem = $nome;
                $model->save(false);

                Yii::$app->session->setFlash('success', 'Imagem guardada!');
            }
        }


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Experiencias model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Experiencias model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Experiencias();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                // Handle file upload
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

                if ($model->imageFile) {
                    $fileName = uniqid() . '.' . $model->imageFile->extension;

                    if ($model->imageFile->saveAs(Yii::getAlias('@webroot/uploads/') . $fileName)) {
                        $model->imagem = $fileName;
                    }
                }

                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Experiência criada com sucesso!');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Erro: ' . json_encode($model->errors));
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Experiencias model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldImage = $model->imagem;

        if ($this->request->isPost && $model->load($this->request->post())) {

            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            if ($model->imageFile) {
                $fileName = uniqid() . '.' . $model->imageFile->extension;

                if ($model->imageFile->saveAs(Yii::getAlias('@webroot/uploads/') . $fileName)) {
                    if ($oldImage && file_exists(Yii::getAlias('@webroot/uploads/') . $oldImage)) {
                        unlink(Yii::getAlias('@webroot/uploads/') . $oldImage);
                    }
                    $model->imagem = $fileName;
                }
            }

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Experiência atualizada com sucesso!');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', 'Erro: ' . json_encode($model->errors));
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Experiencias model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Experiencias model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Experiencias the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Experiencias::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionUpload()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                // file is uploaded successfully
                return;
            }
        }

        return $this->render('upload', ['model' => $model]);
    }
}
