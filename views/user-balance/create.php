<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model c006\user\models\UserBalance */

$this->title = Yii::t('app', 'Create User Balance');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Balances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-balance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
