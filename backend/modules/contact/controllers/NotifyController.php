<?php

namespace derekisbusy\contact\backend\modules\contact\controllers;

use derekisbusy\contact\models\ContactNotifyReason;
use derekisbusy\contact\models\ContactNotify;
use derekisbusy\contact\models\ContactNotifySearch;
use Yii;
use yii\db\Exception;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ContactNotifyController implements the CRUD actions for ContactNotify model.
 */
class NotifyController extends Controller
{
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
     * Lists all ContactNotify models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContactNotifySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ContactNotify model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ContactNotify model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ContactNotify();
        
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try{
            if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
                
                foreach($model->reasons as $reason) {
                    $thru = new ContactNotifyReason;
                    $thru->contact_notify_id = $model->id;
                    $thru->contact_reason_id = $reason;
                    if (!$thru->save()) {
                        throw Exception('Unable to link reason table.');
                    }
                }

                $transaction->commit();

                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    /**
     * Updates an existing ContactNotify model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try{
            if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
                
                ContactNotifyReason::deleteAll('contact_notify_id = :nid', [':nid' => $model->id]);
                
                foreach($model->reasons as $reason) {
                    $thru = new ContactNotifyReason;
                    $thru->contact_notify_id = $model->id;
                    $thru->contact_reason_id = $reason;
                    if (!$thru->save()) {
                        throw Exception('Unable to link reason table.');
                    }
                }
                
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                $model->reasons = ArrayHelper::getColumn($model->getReasons()->asArray()->all(), 'id');
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    /**
     * Deletes an existing ContactNotify model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
    }

    
    /**
     * Finds the ContactNotify model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ContactNotify the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ContactNotify::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
}
