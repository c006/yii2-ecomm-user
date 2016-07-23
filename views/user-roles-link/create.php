<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model c006\user\models\UserRolesLink */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'User Roles Link',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Roles Links'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-roles-link-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
