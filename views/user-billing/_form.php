<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model c006\user\models\UserBilling */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-billing-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'network_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'store_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'user_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => TRUE]) ?>

    <?= $form->field($model, 'exp_month')->dropDownList(\c006\core\assets\CoreHelper::minMaxRange(1, 12, TRUE)) ?>

    <?= $form->field($model, 'exp_year')->dropDownList(\c006\core\assets\CoreHelper::minMaxRange(date('Y'), (int)date('Y') + 20)) ?>

    <?= $form->field($model, 'postal_code')->textInput(['maxlength' => TRUE]) ?>

    <?= $form->field($model, 'default')->dropDownList(['No', 'Yes']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
