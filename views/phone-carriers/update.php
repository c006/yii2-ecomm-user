<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model c006\user\models\PhoneCarriers */

$this->title = Yii::t('app', '', [
    'modelClass' => 'Phone Carriers',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Phone Carriers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="phone-carriers-update">

    <h1 class="title-large"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
