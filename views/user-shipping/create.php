<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model c006\user\models\UserShipping */

$this->title = Yii::t('app', 'Add Shipping Address');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'My Account'), 'url' => '/account'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Settings'), 'url' => '/account/settings'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shipping'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-shipping-create">

    <h1 class="title-large"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
