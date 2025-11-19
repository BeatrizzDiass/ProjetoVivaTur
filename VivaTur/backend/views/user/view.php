<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <p>
        <?php if (Yii::$app->user->can('updateUsers')): ?>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>

        <?php if (Yii::$app->user->can('deleteUsers')): ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'email:email',
            [
                'attribute' => 'status',
                'value' => function($model) {
                    if($model->status == 10) {  // ADICIONAR $model->
                        return 'Active';
                    } else {
                        return 'Inactive';
                    }
                },
            ],
            [
                'attribute' => 'role',
                'label' => 'Perfil/Role',
                'value' => function($model) {
                    $roles = $model->getRoles();
                    if (empty($roles)) {
                        return '<span class="text-muted">Nenhum role atribuído</span>';
                    }
                    $roleNames = [];
                    foreach ($roles as $role) {
                        $roleNames[] = $role->description ?: $role->name;
                    }
                    return implode(', ', $roleNames);
                },
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
