<?php

namespace derekisbusy\contact\frontend\modules\contact\controllers;

use derekisbusy\contact\frontend\modules\contact\Module;
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
        $model->referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
        
        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            $body = "Name: {$model->name}\r\n"
                . "Email: {$model->email}\r\n"
                . "Phone: {$model->phone}\r\n"
                . "Message: {$model->body}";
            if (Yii::$app->params['adminEmail']) {
                $result = Yii::$app->mailer->compose()
                ->setTo(Yii::$app->params['adminEmail'])
                ->setReplyTo([$model->email => $model->name])
                ->setFrom(Yii::$app->params['adminEmail'])
                ->setSubject('Contact: '.$model->reason->reason)
                ->setTextBody($body)
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
                    ->setTextBody($body)
                    ->send();
            }
            
            Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            
            return $this->refresh();
        } else {
            return $this->render($this->module->viewSettings[Module::VIEW_CONTACT], [
                'model' => $model,
            ]);
        }
    }
}
