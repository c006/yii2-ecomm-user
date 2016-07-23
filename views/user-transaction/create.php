<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model c006\user\models\UserTransaction */

$this->title = Yii::t('app', 'Create User Transaction');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Transactions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-transaction-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
