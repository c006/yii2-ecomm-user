<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model c006\user\models\UserTransaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-transaction-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'network_id')->textInput() ?>

    <?= $form->field($model, 'store_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'transaction_type_id')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => TRUE]) ?>

    <?= $form->field($model, 'transaction_id')->textInput(['maxlength' => TRUE]) ?>

    <?= $form->field($model, 'timestamp')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-secondary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
