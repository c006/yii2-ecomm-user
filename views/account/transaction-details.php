<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model c006\user\models\UserTransaction */

$this->title = 'Transaction Details';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transaction Details'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-transaction-view">

    <h1 class="title-large"><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model'      => $model,
        'attributes' => [
//            'id',
//            'network_id',
            'store_id',
//            'user_id',
//            [
//                'label'     => 'Type',
//                'format'    => 'raw',
//                'value'     => function ($model) {
//                    $m = AppHelper::getTransactionType($model->transaction_type_id);
//                    print_r($m); exit;
//                    if (sizeof($m)) {
//                        return $m['name'];
//                    }
//
//                    return '';
//                }
//            ],
            'amount',
            'transaction_id',
            'timestamp:datetime',
        ],
    ]) ?>

</div>
