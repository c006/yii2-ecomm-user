<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel c006\user\models\search\PhoneCarriers */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Phone Carriers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phone-carriers-index">

    <h1 class="title-large"><?= Html::encode($this->title) ?></h1>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <p>
        <?= Html::a(Yii::t('app', 'Create Phone Carriers'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

            <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

                    'id',
            'name',

        [
        'class' => 'yii\grid\ActionColumn',
        'template' => '<div class="nowrap">{update} {delete}</div>'
        ],
        ],
        ]); ?>
    
</div>
