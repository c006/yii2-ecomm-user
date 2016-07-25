<?php

use c006\activeForm\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model c006\user\models\UserNotification */
/* @var $form c006\activeForm\ActiveForm; */
?>

<div class="form-user-notification">

    <?php $form = ActiveForm::begin([]); ?>

    <?//= $form->field($model, 'id')->textInput(['maxlength' => TRUE]) ?>

    <?//= $form->field($model, 'network_id')->textInput() ?>

    <?= $form->field($model, 'notification_type_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>

    <?//= $form->field($model, 'timestamp')->textInput() ?>

    <?//= $form->field($model, 'read')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-secondary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?= c006\spinner\SubmitSpinner::widget(['form_id' => $form->id]); ?>



