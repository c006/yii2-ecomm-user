<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model c006\user\models\UserRoles */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
        'modelClass' => 'User Roles',
    ]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->user_roles_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-roles-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
