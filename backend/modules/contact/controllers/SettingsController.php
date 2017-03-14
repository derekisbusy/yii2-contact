<?php

namespace derekisbusy\contact\backend\modules\contact\controllers;

use yii\web\Controller;

/**
 * Settings controller for the `contact` module
 */
class SettingsController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
