<?php

namespace c006\user\controllers;

use c006\alerts\Alerts;
use c006\core\assets\CoreHelper;
use c006\user\assets\AppHelper;
use c006\user\assets\AssetGridView;
use c006\user\models\search\UserNotification as UserNotificationSearch;
use c006\user\models\UserNotification;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * UserNotificationController implements the CRUD actions for UserNotification model.
 */
class UserNotificationController extends Controller
{

    function init()
    {
//        $this->layout = '@c006/user/views/layouts/main';
        if (CoreHelper::checkLogin() && CoreHelper::isGuest()) {
            return $this->redirect('/user');
        }
    }

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
     * Lists all UserNotification models.
     * @return mixed
     */
    public function actionIndex()
    {

        if (isset($_POST['Read'])) {
            $post = $_POST['Read'];

            foreach ($post as $key => $value) {
                if ($value) {
                    AppHelper::markReadNotification($key);
                    Alerts::setMessage('Notification updated');
                    Alerts::setAlertType(Alerts::ALERT_SUCCESS);
                    Alerts::setCountdown(4);
                }
            }
            $this->redirect(['index']);
        }

        parent::init();
        AssetGridView::register($this->getView());

        $user = AppHelper::getUser();
        $searchModel = new UserNotificationSearch();
        $searchModel->user_id = $user['id'];
        $searchModel->network_id = $user['network_id'];
        $searchModel->store_id = $user['store_id'];
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserNotification model.
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
     * Creates a new UserNotification model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserNotification();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserNotification model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param string $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserNotification model.
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
     * Finds the UserNotification model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param string $id
     *
     * @return UserNotification the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserNotification::findOne($id)) !== NULL) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
