<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model c006\user\models\UserNotification */

$this->title = Yii::t('app', 'Create User Notification');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'My Account'), 'url' => '/account'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Notifications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-notification-create">

    <h1 class="title-large"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
