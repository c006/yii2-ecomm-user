<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model c006\user\models\UserBilling */

$this->title = Yii::t('app', 'Update Billing Address') . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'My Account'), 'url' => '/account'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Settings'), 'url' => '/account/settings'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Billings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-billing-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
