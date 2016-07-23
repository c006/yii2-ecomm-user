<?php

namespace c006\user\controllers;


use c006\user\assets\CoreHelper;

use Yii;
use c006\user\models\PhoneCarriers;
    use c006\user\models\search\PhoneCarriers as PhoneCarriersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
* PhoneCarriersController implements the CRUD actions for PhoneCarriers model.
*/
class PhoneCarriersController extends Controller
{

function init() {
$this->layout = '@c006/user/views/layouts/main';
if (CoreHelper::checkLogin() && CoreHelper::isGuest()) {
return $this->redirect('/user');
}
}

public function behaviors()
{
return [
'verbs' => [
'class' => VerbFilter::className(),
'actions' => [
'delete' => ['post'],
],
],
];
}

/**
* Lists all PhoneCarriers models.
* @return mixed
*/
public function actionIndex()
{
    $searchModel = new PhoneCarriersSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
    'searchModel' => $searchModel,
    'dataProvider' => $dataProvider,
    ]);
}

/**
* Displays a single PhoneCarriers model.
* @param integer $id
* @return mixed
*/
public function actionView($id)
{
return $this->render('view', [
'model' => $this->findModel($id),
]);
}

/**
* Creates a new PhoneCarriers model.
* If creation is successful, the browser will be redirected to the 'view' page.
* @return mixed
*/
public function actionCreate()
{
$model = new PhoneCarriers();

if ($model->load(Yii::$app->request->post()) && $model->save()) {
return $this->redirect(['index', 'id' => $model->id]);
} else {
return $this->render('create', [
'model' => $model,
]);
}
}

/**
* Updates an existing PhoneCarriers model.
* If update is successful, the browser will be redirected to the 'view' page.
* @param integer $id
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
* Deletes an existing PhoneCarriers model.
* If deletion is successful, the browser will be redirected to the 'index' page.
* @param integer $id
* @return mixed
*/
public function actionDelete($id)
{
$this->findModel($id)->delete();

return $this->redirect(['index']);
}

/**
* Finds the PhoneCarriers model based on its primary key value.
* If the model is not found, a 404 HTTP exception will be thrown.
* @param integer $id
* @return PhoneCarriers the loaded model
* @throws NotFoundHttpException if the model cannot be found
*/
protected function findModel($id)
{
if (($model = PhoneCarriers::findOne($id)) !== null) {
return $model;
} else {
throw new NotFoundHttpException('The requested page does not exist.');
}
}
}