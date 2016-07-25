<?php

namespace c006\user\controllers;

use c006\alerts\Alerts;
use c006\user\assets\AppHelper;
use c006\user\assets\AssetGridView;
use c006\user\models\search\UserBilling as UserBillingSearch;
use c006\user\models\UserBilling;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * UserBillingController implements the CRUD actions for UserBilling model.
 */
class UserBillingController extends Controller
{


    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all UserBilling models.
     * @return mixed
     */
    public function actionIndex()
    {
        parent::init();
        AssetGridView::register($this->getView());

        $searchModel  = new UserBillingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserBilling model.
     *
     * @param string $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UserBilling model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserBilling();

        if (isset($_POST['UserBilling'])) {
            $post              = $_POST['UserBilling'];
            $model->attributes = $post;
            $model->network_id = AppHelper::getNetwork();
            $model->store_id   = AppHelper::getStore();
            $model->user_id    = Yii::$app->user->id;

            if ($model->validate() && $model->save()) {
                Alerts::setAlertType(Alerts::ALERT_SUCCESS);
                Alerts::setMessage('The billing address has been created');

                return $this->redirect('/account/billing');
            } else {
                Alerts::setAlertType(Alerts::ALERT_WARNING);
                Alerts::setMessage('An error occurred, please try again or contact us');
            }
        }

        $model->network_id = 0;
        $model->store_id   = 0;
        $model->user_id    = 0;

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UserBilling model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param string $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (isset($_POST['UserBilling'])) {
            $post              = $_POST['UserBilling'];
            $model->attributes = $post;
            $model->network_id = AppHelper::getNetwork();
            $model->store_id   = AppHelper::getStore();
            $model->user_id    = Yii::$app->user->id;

            if ($model->validate() && $model->save()) {
                Alerts::setAlertType(Alerts::ALERT_SUCCESS);
                Alerts::setMessage('The billing address has been updated');

                return $this->redirect('/account/billing');
            } else {
                Alerts::setAlertType(Alerts::ALERT_WARNING);
                Alerts::setMessage('An error occurred, please try again or contact us');
            }
        }

        $model->network_id = 0;
        $model->store_id   = 0;
        $model->user_id    = 0;

        return $this->render('update', [
            'model' => $model,
        ]);

    }

    /**
     * Deletes an existing UserBilling model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param string $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserBilling model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param string $id
     *
     * @return UserBilling the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserBilling::findOne($id)) !== NULL) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
