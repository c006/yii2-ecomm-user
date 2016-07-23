<?php

use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel c006\user\models\search\UserNotification */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Notifications');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'My Account'), 'url' => '/account'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-notification-index">

    <h1 class="title-large"><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button(Yii::t('app', 'Mark All as Read'), ['class' => 'btn btn-success button-all-read']) ?>
    </p>

    <?php $form = ActiveForm::begin(['id' => 'form-notifications']); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'network_id',
//            'store_id',
//            'user_id',
        [
            'attribute'=>'message',
            'format'=> 'raw',

        ],

            'timestamp:datetime',
//             'read',

            [
                'label'     => 'Read',
                'attribute' => 'read',
                'format'    => 'raw',
                'value'     => function ($model) {
                    return '<div class="align-center">' . (($model->read) ? '<span class="icon icon-okay" ></span>' :
                        Html::button(Yii::t('app', 'Mark Read'), ['class' => 'btn btn-success button-read']) .
                        '<input type="hidden" class="hidden-read" name="Read[' . $model->id . ']" value="0" />') .
                    '</div>';
                }

            ],

            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '<div class="nowrap">{delete}</div>'
            ],
        ],
    ]); ?>

    <?php ActiveForm::end(); ?>

</div>

<?php if (class_exists('c006\\spinner\\SubmitSpinner')) : ?>
    <?= c006\spinner\SubmitSpinner::widget(['form_id' => $form->id]); ?>
<?php endif ?>


<script type="text/javascript">
    jQuery(function () {
        jQuery('.button-read')
            .click(function () {
                var $this = jQuery(this);
                $this.parent().find('input[type=hidden]').val(1);
                jQuery('#<?= $form->id ?>').submit();
            });
        jQuery('.button-all-read')
            .click(function () {
                jQuery('.hidden-read').each(function () {
                    var $this = jQuery(this);
                    $this.parent().find('input[type=hidden]').val(1);
                });
                jQuery('#<?= $form->id ?>').submit();
            });


    });
</script>















