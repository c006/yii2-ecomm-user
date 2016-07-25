<?php

namespace c006\user\controllers;

use c006\core\assets\CoreHelper;
use c006\user\assets\AppHelper;
use c006\user\models\form\Transactions;
use c006\user\models\search\UserTransaction;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Class AccountController
 *
 * @package c006\user\controllers
 */
class AccountController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['logout', 'signup'],
                'rules' => [
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     *
     */
    function init()
    {
        if (\Yii::$app->user->isGuest) {
            return $this->redirect('/user/login');
        }

        $this->layout = '@frontend/views/layouts/account';
    }

    /**
     *
     */
    public function actionIndex()
    {

        $model = AppHelper::getUser();

        return $this->render('dashboard',
            ['model' => $model]);
    }


    public function actionTransactions()
    {
        $searchModel  = new UserTransaction();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model        = new Transactions();
        $items        = AppHelper::getTransactions(1000000);

        if (isset($_POST['Transactions'])) {
            $array            = [];
            $post             = $_POST['Transactions'];
            $model->date_from = $post['date_from'];
            $model->date_to   = $post['date_to'];
            if ($model->date_from && $model->date_to) {
                $date_from = CoreHelper::dateToTime($model->date_from);
                $date_to   = CoreHelper::dateToTime($model->date_to);
                foreach ($items as $item) {
                    if ($item['timestamp'] >= $date_from && $item['timestamp'] <= $date_to) {
                        $array[] = $item;
                    }
                }
                $items = $array;
            }

        }

        return $this->render('transactions', [
            'model'        => $model,
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
            'items'        => $items,
        ]);
    }

    public function actionTransactionDetails($id)
    {

        $model = \c006\user\models\UserTransaction::findOne($id);

        return $this->render('transaction-details', [
            'model' => $model,
        ]);
    }


}
