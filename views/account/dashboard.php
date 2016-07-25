<?php

use c006\user\assets\AppHelper;
use yii\helpers\Html;

$tally = 0;
$user  = AppHelper::getUserBy('id', Yii::$app->user->id);
?>

<div class="item-container-heavy">

    <div class="item-container no-border">
        <?= Html::a(Yii::t('app', 'Friends'), '/account/friends', ['class' => 'btn btn-secondary']) ?>
        <?= Html::a(Yii::t('app', 'Add Funds'), '/account/funds/add', ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Send Funds'), '/account/funds', ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Lending'), '/account/funds/loans', ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'All Notifications ( ' . sizeof(AppHelper::getNotification(-1, TRUE)) . ' )'), '/account/notifications', ['class' => 'btn btn-secondary']) ?>
        <?= Html::a(Yii::t('app', 'All Transactions'), '/account/transactions', ['class' => 'btn btn-secondary']) ?>
        <!--        --><? //= Html::a(Yii::t('app', 'Billing'), '/account/billing', ['class' => 'btn btn-primary']) ?>
        <!--        --><? //= Html::a(Yii::t('app', 'Shipping'), '/account/shipping', ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Preferences'), '/account/settings', ['class' => 'btn btn-secondary']) ?>
    </div>

    <div class="table">

        <div class="table-row">

            <div class="table-cell padding-10">
                <div class="item-container grid-view">
                    <div class="title-heading">
                        <a href="/account/notifications" title="View Notifications">Recent Notifications</a>
                    </div>
                    <div class="table">
                        <div class="table">
                            <?php $items = AppHelper::getNotification(5, TRUE); ?>
                            <?php if (sizeof($items)) : ?>
                                <?php foreach ($items as $item) : ?>
                                    <div class="table-row <?= $item['notificationType']['css'] ?>">
                                        <div class="table-cell"><?= date('D M j, Y', $item['timestamp']) ?></div>
                                        <div class="table-cell"><?= $item['message'] ?></div>
                                    </div>
                                <?php endforeach ?>
                            <?php else : ?>
                                <div class="text">No notifications</div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-cell padding-10">
                <div id="balance-container" class="item-container nowrap">
                    <div class="title-text"><?= $user['first_name'] ?> <?= $user['last_name'] ?></div>
                    <span class="title-heading"><a href="/account/update-balance" title="Recalculate Balance">My Balance</a>: </span>
                    <span class="title-text"><?= Yii::$app->params['currency_sign'] ?><?= number_format(AppHelper::getUserBalance() + 0.00, 2) ?></span>
                </div>
            </div>
        </div>

        <div class="table-cell width-80 padding-10">
            <div id="transactions-container" class="item-container grid-view">
                <div class="title-heading">
                    <a href="/account/transactions" title="View Transactions">My Recent Transactions</a>
                </div>
                <div class="table">
                    <?php $items = AppHelper::getTransactions(5); ?>

                    <div class="table">
                        <?php if (sizeof($items)) : ?>
                            <?php foreach ($items as $item) : ?>
                                <?php
                                $tally += $item['amount'];
                                $class       = '';
                                $tally_class = ($tally < 0) ? 'bg-red' : 'bg-green';
                                ?>
                                <div class="table-row <?= $item['transactionType']['css'] ?>">
                                    <div class="table-cell"><?= date('D M j, Y', $item['timestamp']) ?></div>
                                    <div class="table-cell"><?= $item['ledger'] ?></div>
                                    <div class="table-cell"><?= $item['transactionType']['name'] ?></div>
                                    <div class="table-cell"><?= Yii::$app->params['currency_sign'] ?><?= number_format($item['amount'] + 0.00, 2) ?></div>
                                    <!--                                    <div class="table-cell">--><? //= Yii::$app->params['currency_sign'] ?><!---->
                                    <? //= number_format($tally + 0.00, 2) ?><!--</div>-->
                                </div>
                            <?php endforeach ?>
                            <div class="table-row hide">
                                <div class="table-cell"></div>
                                <div class="table-cell"></div>
                                <div class="table-cell"></div>
                                <div class="table-cell bold align-right">Last 5 Transactions:</div>
                                <div class="table-cell bold <?= $tally_class ?>"><?= Yii::$app->params['currency_sign'] ?><?= number_format($tally + 0.00, 2) ?></div>
                            </div>
                        <?php else : ?>
                            <div class="text">No transactions yet</div>
                        <?php endif ?>
                    </div>

                </div>
            </div>
        </div>

        <div class="table-cell width-20 padding-10 vertical-align-top">
            <div class="item-container">Coupon Item</div>
            <div class="item-container">Coupon Item</div>
            <div class="item-container">Coupon Item</div>
            <div class="item-container">Coupon Item</div>
        </div>

    </div>


</div>
