<?php

namespace derekisbusy\contact\frontend\modules\contact\controllers;

use derekisbusy\contact\models\Contact;
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

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->render(['success']);
        } else {
            return $this->render('form', [
                'model' => $model,
            ]);
        }
    }
}
