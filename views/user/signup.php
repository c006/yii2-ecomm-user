<?php
use c006\activeForm\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model c006\user\models\form\Signup */

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-signup">
    <h1 class="title-large"><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields:</p>

    <div class="">
        <?php $form = ActiveForm::begin(['id' => 'form-signup', 'validateOnType' => TRUE]); ?>
        <?= $form->field($model, 'first_name') ?>
        <?= $form->field($model, 'last_name') ?>
        <div class="table">
            <div class="table-cell width-50 padding-right-10"><?= $form->field($model, 'email') ?></div>
            <div class="table-cell width-50"><?= $form->field($model, 'email_match') ?></div>
        </div>
        <div class="table">
            <div class="table-cell width-50 padding-right-10"><?= $form->field($model, 'password')->passwordInput() ?></div>
            <div class="table-cell width-50"><?= $form->field($model, 'password_match')->passwordInput() ?></div>
        </div>
        <?= $form->field($model, 'phone') ?>
        <div class="form-group">
            <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'id' => 'button-submit']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>


<?php if (class_exists('c006\\spinner\\SubmitSpinner')) : ?>
    <?= c006\spinner\SubmitSpinner::widget(['form_id' => $form->id]); ?>
<?php endif ?>

<script type="text/javascript">
    jQuery(function () {

        jQuery('#button-submit')
            .click(function () {
                setTimeout(function () {
                    var $form = jQuery('#<?= $form->id ?>');
                    console.log($form.find('div.has-error').length);
                    if ($form.find('div.has-error').length) {
                        hide_submit_spinner();
                    }
                }, 500);
            });


        <?php if (class_exists('common\\assets\\AssetExtrasJs')) : ?>
        var $extras = new Extras();
        $extras.init();
        <?php endif ?>
    });
</script>
