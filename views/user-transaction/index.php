<?php

use c006\user\assets\AppHelper;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel c006\user\models\search\UserTransaction */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('app', 'User Transactions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-transaction-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create User Transaction'), ['create'], ['class' => 'btn btn-secondary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],

            //            'id',
            //            'network_id',
            'store_id',
            'user_id',
            'transaction_type_id',
            [
                'attribute' => 'transaction_type_id',
                'label'     => 'Type',
                'format'    => 'raw',
                'value'     => function ($model) {
                    return AppHelper::getTransactionType($model->transaction_type_id)['name'];
                },
            ],

            // 'amount',
            // 'transaction_id',
            // 'timestamp:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
