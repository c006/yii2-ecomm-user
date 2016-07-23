<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model c006\user\models\PhoneCarriers */

$this->title = Yii::t('app', 'Create Phone Carriers');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Phone Carriers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phone-carriers-create">

    <h1 class="title-large"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
