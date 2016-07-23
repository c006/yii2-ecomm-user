<?php

namespace c006\user\controllers;

use c006\alerts\Alerts;
use c006\user\assets\AppHelper;
use Yii;
use yii\web\Controller;

/**
 * Class TokensController
 *
 * @package c006\user\controllers
 */
class TokensController extends Controller
{


    /**
     * @inheritdoc
     */
//    public function actions()
//    {
//        return [
//            'error' => [
//                'class' => 'yii\web\ErrorAction',
//            ],
//        ];
//    }

    /**
     * @inheritdoc
     */
//    public function behaviors()
//    {
//        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'only'  => ['index'],
//                'rules' => [
//                    ['allow'   => TRUE,
//                     'actions' => ['index'],
//                     'roles'   => ['?'],
//                    ],
//                ],
//            ],
//        ];
//    }

    /**
     *
     */
    public function actionIndex()
    {
        if (isset($_GET['token'])) {

            $action = AppHelper::getSecureToken($_GET['token']);
            if (sizeof($action)) {
                if ($action['expires'] > time()) {
                    return $this->redirect($action['uri'] . '/?token=' . $action['security']);
                }
                Alerts::setMessage('The token has expired. Please request a new token or revisit the prior page.<br>Tokens protect your account from intrusion.');
                Alerts::setAlertType(Alerts::ALERT_INFO);

                return $this->redirect('/account');
            }
        }

        Alerts::setMessage('We could not find a matching token. Please request a new token or revisit the prior page.');
        Alerts::setAlertType(Alerts::ALERT_INFO);

        return $this->redirect('/account');
    }


}
