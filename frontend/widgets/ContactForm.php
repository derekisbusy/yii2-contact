<?php

namespace derekisbusy\contact\frontend\widgets;

use derekisbusy\contact\models\Contact;


class ContactForm extends \yii\base\Widget
{
    
    public $view = '_form';
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
        return $this->render($this->view, ['model' => $this->model, 'message' => $this->message]);
    }
}