<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model c006\user\models\form\PasswordResetRequest */

$this->title                   = 'Request password reset';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'account'), 'url' => ['/account']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-request-password-reset">
    <h1 class="title-large"><?= Html::encode($this->title) ?></h1>

    <div class="item-container">
        <div class="col-lg-0">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
            <?= $form->field($model, 'email')->hint('Please fill out your email. A link to reset password will be sent there.') ?>
            <div class="form-group">
                <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
