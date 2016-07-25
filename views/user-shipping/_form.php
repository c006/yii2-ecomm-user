<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model c006\user\models\UserShipping */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-shipping-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => TRUE]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => TRUE]) ?>

    <?= $form->field($model, 'address_apt')->textInput(['maxlength' => TRUE]) ?>

    <div class="table">
        <div class="table-cell width-50"><?= $form->field($model, 'postal_code_id')->textInput()->label('Postal Code') ?></div>
        <div class="table-cell align-center vertical-align-middle">
            <?= Html::button('Lookup City / State', ['id' => 'lookup', 'class' => 'btn btn-primary']) ?>
            <span id="lookup-message"></span>
        </div>
    </div>


    <?= $form->field($model, 'city_id')->textInput()->label('City') ?>

    <?
    $model_link = \c006\cspc\models\State::find()->orderBy('data')->all();
    $model_link = ArrayHelper::map($model_link, 'state_id', 'data');
    echo $form->field($model, 'state_id')->dropDownList($model_link)->label('City') ?>

    <?
    $model_link = \c006\cspc\models\Country::find()
        ->where(['like', 'char2', 'US'])
        ->orWhere(['like', 'char2', 'UM'])
        ->orderBy('data')->all();
    $model_link = ArrayHelper::map($model_link, 'country_id', 'data');
    echo $form->field($model, 'country_id')->dropDownList($model_link)->label('Country') ?>

    <?= $form->field($model, 'default')->dropDownList(['No', 'Yes']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-secondary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
    jQuery(function () {
        jQuery('#lookup')
            .click(function () {
                var $postal = jQuery('#usershipping-postal_code_id');
                if ($postal.val().length) {
                    jQuery.ajax({
                        url: '/lookup/postal?postal=' + $postal.val(),
                        success: function (result) {
                            console.log(result);
                        }
                    });
                }
            });
    });
</script>
