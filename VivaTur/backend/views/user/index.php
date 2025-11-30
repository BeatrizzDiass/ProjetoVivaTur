<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <p>
        <?php if (Yii::$app->user->can('createUsers')): ?>
            <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
        <?php endif; ?>
    </p>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'auth_key',
            'email:email',
            [
                'attribute' => 'status',
                'value' => function($model) {
                    if($model->status == 10) {
                        return 'Active';
                    } else {
                        return 'Inactive';
                    }
                },
            ],
            [
                'attribute' => 'roles',
                'format' => 'raw',
                'label' => 'Roles',
                'value' => function ($model) {
                    $roles = $model->getRoles();
                    $roleNames = array_map(function($role) {
                        return Html::tag('span', $role->name, ['class' => 'badge bg-primary text-white me-1']);
                    }, $roles);
                    return implode(' ', $roleNames);
                },
            ],
            [
                'class' => ActionColumn::className(),
                'visibleButtons' => [
                    'update' => Yii::$app->user->can('updateUsers'),
                    'delete' => Yii::$app->user->can('deleteUsers'),


                ],
                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
