<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel c006\user\models\search\UserShipping */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Shipping Addresses');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'My Account'), 'url' => '/account'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Settings'), 'url' => '/account/settings'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-shipping-index">

    <h1 class="title-large"><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Add Shipping Address'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],
//
//            'id',
            'name',
            'address',
            'address_apt',
            'city_id',
            'state_id',
            'postal_code_id',
            'country_id',
            'default',

            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '<div class="nowrap">{edit} {delete}</div>'
            ],
        ],
    ]); ?>

</div>
