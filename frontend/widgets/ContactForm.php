<?php

namespace derekisbusy\contact\frontend\widgets;

use derekisbusy\contact\models\Contact;


class ContactForm extends \yii\base\Widget
{
    public $model;
    
    /**
     * Display textarea for message input.
     * @var boolean
     */
    public $message = true;
    
    public $defaultReason;
    
    public function init()
    {
        parent::init();
        if (!$this->model) {
            $this->model = new Contact;
        }
        if ($this->defaultReason) {
            $this->model->contact_reason_id = $this->defaultReason;
        }
    }
    
    public function run()
    {
        return $this->render('_form', ['model' => $this->model, 'message' => $this->message]);
    }
}