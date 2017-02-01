<?php

namespace derekisbusy\contact\frontend\widgets;

use derekisbusy\contact\models\Contact;


class ContactForm extends \yii\base\Widget
{
    public $model;
    
    public function init()
    {
        parent::init();
        if (!$this->model) {
            $this->model = new Contact;
        }
    }
    
    public function run()
    {
        return $this->render('_form', ['model' => $this->model]);
    }
}