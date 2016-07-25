<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var $model c006\user\models\User */

$this->title                   = Yii::t('app', 'User Preferences');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'My Account'), 'url' => '/account'];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php if (FALSE) : ?>
<p>
    <?= Html::a(Yii::t('app', 'Shipping Address'), '/account/shipping', ['class' => 'btn btn-secondary']) ?>
    <?= Html::a(Yii::t('app', 'Billing Address'), '/account/billing', ['class' => 'btn btn-secondary']) ?>
</p>
<?php endif; ?>

<div class="">
    <h1 class="title-large"><?= Html::encode($this->title) ?></h1>

    <div class="item-row">
        <div class="col-lg-0">
            <?php $form = ActiveForm::begin(['id' => 'form-preferences']); ?>
            <?= $form->field($model, 'first_name') ?>
            <?= $form->field($model, 'last_name') ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'phone') ?>
            <div class="form-group">
                <?= Html::submitButton('Update', ['class' => 'btn btn-primary', 'name' => 'button-update']) ?>
                <?= Html::button('Reset Password', ['class' => 'btn btn-active', 'id' => 'button-reset']) ?>
            </div>
            <?php ActiveForm::end(); ?>

            <?php $form = ActiveForm::begin(['id' => 'form-reset', 'action' => '/user/request-password-reset']); ?>
            <input type="hidden" name="PasswordResetRequestForm[email]" value="<?= $model->email ?>"/>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(function () {
        jQuery('#button-reset')
            .click(function () {
                jQuery('#form-reset').submit();
            });
    });
</script>
