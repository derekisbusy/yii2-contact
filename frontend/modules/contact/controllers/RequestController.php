<?php

namespace derekisbusy\contact\frontend\modules\contact\controllers;

use derekisbusy\contact\models\base\ContactNotifyReason;
use derekisbusy\contact\models\Contact;
use derekisbusy\contact\models\ContactNotify;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `contact` module
 */
class RequestController extends Controller
{
    
    public $defaultAction = 'form';
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionForm()
    {
        
        $model = new Contact();
        
        $model->url = $_SERVER['REQUEST_URI'];
        $model->referrer = $_SERVER['HTTP_REFERER'];
        
        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            
            if (Yii::$app->params['adminEmail']) {
                $result = Yii::$app->mailer->compose()
                ->setTo(Yii::$app->params['adminEmail'])
                ->setFrom([$model->email => $model->name])
                ->setSubject('Contact: '.$model->reason->reason)
                ->setTextBody($model->body)
                ->send();
            }
            
            $rows = (new \yii\db\Query())
                ->select(['email'])
                ->from(ContactNotify::tableName().' n')
                ->innerJoin(ContactNotifyReason::tableName().' r', 'r.contact_notify_id = n.id')
                ->where('r.contact_reason_id = :reason', [':reason' => $model->reason->id])
                ->all();
            
            
            foreach ($rows as $row) {
                $result = Yii::$app->mailer->compose()
                    ->setTo($row['email'])
                    ->setFrom([$model->email => $model->name])
                    ->setSubject('Contact: '.$model->reason->reason)
                    ->setTextBody($model->body)
                    ->send();
            }
            
            Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            
            return $this->refresh();
        } else {
            return $this->render('form', [
                'model' => $model,
            ]);
        }
    }
}
