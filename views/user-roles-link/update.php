<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model c006\user\models\UserRolesLink */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
        'modelClass' => 'User Roles Link',
    ]) . ' ' . $model->user_roles_link_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Roles Links'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_roles_link_id, 'url' => ['view', 'id' => $model->user_roles_link_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-roles-link-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
