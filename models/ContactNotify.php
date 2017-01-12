<?php

namespace derekisbusy\contact\models;

use derekisbusy\contact\models\base\ContactNotify as BaseContactNotify;

/**
 * This is the model class for table "contact_notify".
 */
class ContactNotify extends BaseContactNotify
{
    public $reasons;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['email','reasons'], 'required'],
            [['email'], 'string', 'max' => 255],
            [['email'], 'email']
        ]);
    }
    
    public function getReasons()
    {
        return $this->hasMany(base\ContactReason::className(), ['id' => 'contact_reason_id'])
            ->viaTable(base\ContactNotifyReason::tableName(), ['contact_notify_id' => 'id']);
    }
    
}
