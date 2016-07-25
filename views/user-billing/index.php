<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel c006\user\models\search\UserBilling */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('app', 'Billing Addresses');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'My Account'), 'url' => '/account'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Settings'), 'url' => '/account/settings'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-billing-index">

    <h1 class="title-large"><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create User Billing'), ['create'], ['class' => 'btn btn-secondary']) ?>

    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],

            //                    'id',
            //            'network_id',
            //            'store_id',
            //            'user_id',
            'name',
            'exp_month',
            'exp_year',
            'postal_code',
            'default',

            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '<div class="nowrap">{update} {delete}</div>',
            ],
        ],
    ]); ?>

</div>
