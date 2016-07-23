<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel c006\user\models\search\UserTransaction */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model c006\user\models\form\Transactions */
/** @var $items Array */

$this->title = Yii::t('app', 'User Transactions');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'My Account'), 'url' => '/account'];
$this->params['breadcrumbs'][] = $this->title;

$tally = 0;
?>

<div class="user-transaction-index">

    <h1 class="title-large"><?= Html::encode($this->title) ?></h1>

    <div class="item-container">
        <?php $form = ActiveForm::begin(['id' => 'form-sort']); ?>

        <div class="table">
            <div class="table-cell width-40 padding-right-10"><?= $form->field($model, 'date_from')
                    ->widget(\yii\jui\DatePicker::classname(), [
                        //'language' => 'ru',
                        'dateFormat' => 'yyyy-MM-dd',
                    ])->textInput(['class' => 'form-control'])
                ?></div>
            <div class="table-cell width-40"><?= $form->field($model, 'date_to')
                    ->widget(\yii\jui\DatePicker::classname(), [
                        //'language' => 'ru',
                        'dateFormat' => 'yyyy-MM-dd',
                    ])->textInput(['class' => 'form-control']) ?></div>
            <div class="table-cell align-center vertical-align-middle">
                <?= Html::SubmitButton('Go', ['class' => 'btn btn-primary', 'name' => 'button-submit']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php /* GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'network_id',
//            'store_id',
            'amount',
            'transaction_id',
            [
                'label'     => 'Date',
                'attribute' => 'timestamp',
                'format'    => 'datetime',
            ],

            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '<div class="nowrap"></div>'
            ],
        ],
    ]); */ ?>

    <div id="transactions-container" class="item-container grid-view">
        <div class="table">
            <?php if (sizeof($items)) : ?>
                <div class="table-row">
                    <div class="table-cell">Date</div>
                    <div class="table-cell">Ledger</div>
                    <div class="table-cell">Type</div>
                    <div class="table-cell">Amount</div>
                    <div class="table-cell">Running Balance</div>
                    <div class="table-cell align-center"></div>
                </div>
                <?php foreach ($items as $item) : ?>
                    <?php
                    $tally += $item['amount'];
                    $class = '';
                    $tally_class = ($tally < 0) ? 'bg-red' : 'bg-green';
                    ?>
                    <div class="table-row <?= $item['transactionType']['css'] ?>">
                        <div class="table-cell"><?= date('D M j, Y', $item['timestamp']) ?></div>
                        <div class="table-cell"><?= $item['ledger'] ?></div>
                        <div class="table-cell"><?= $item['transactionType']['name'] ?></div>
                        <div class="table-cell"><?= Yii::$app->params['currency_sign'] ?><?= number_format($item['amount'] + 0.00, 2) ?></div>
                        <div class="table-cell"><?= Yii::$app->params['currency_sign'] ?><?= number_format($tally + 0.00, 2) ?></div>
                        <div class="table-cell align-center"><?= Html::a(Yii::t('app', 'Details'), '/account/transaction/details?id=' . $item['id'], ['class' => 'btn btn-primary']) ?></div>
                    </div>
                <?php endforeach ?>
                <div class="table-row">
                    <div class="table-cell"></div>
                    <div class="table-cell"></div>
                    <div class="table-cell"></div>
                    <div class="table-cell bold align-right">Current Balance:</div>
                    <div class="table-cell bold <?= $tally_class ?>"><?= Yii::$app->params['currency_sign'] ?><?= number_format($tally + 0.00, 2) ?></div>
                </div>
            <?php else : ?>
                <div class="text">No transactions yet</div>
            <?php endif ?>
        </div>
    </div>

</div>


