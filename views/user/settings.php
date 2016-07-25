<?php
use yii\bootstrap\Html;

/** @var $model_form c006\user\models\form\FriendTransfer */
/** @var $model Array */

$this->title                   = Yii::t('app', 'Settings');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'My Account'), 'url' => '/account'];
$this->params['breadcrumbs'][] = $this->title;
?>

<style>

</style>

<div id="funds-container">

    <h1 class="title-large"><?= Html::encode($this->title) ?></h1>


    <div class="table">
        <div class="table-cell align-right width-5">
            <?= Html::button(Yii::t('app', 'Preferences'), ['id' => 'button-preferences', 'class' => 'btn btn-secondary margin-top-10']) ?>
            <?= Html::button(Yii::t('app', 'Shipping'), ['id' => 'button-shipping', 'class' => 'btn btn-secondary margin-top-10']) ?>
            <?= Html::button(Yii::t('app', 'Billing'), ['id' => 'button-shipping', 'class' => 'btn btn-secondary margin-top-10']) ?>
        </div>
        <div class="table-cell">

            <div id="preferences">

                <div class="item-container">
                    <?= $preferences; ?>
                </div>

            </div>


        </div>

    </div>

</div>