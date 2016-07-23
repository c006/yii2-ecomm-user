<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model c006\user\models\UserTransaction */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transaction Details'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-transaction-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
                'id',
            'network_id',
            'store_id',
            'user_id',
            'transaction_type_id',
            'amount',
            'transaction_id',
            'timestamp:datetime',
    ],
    ]) ?>

</div>
