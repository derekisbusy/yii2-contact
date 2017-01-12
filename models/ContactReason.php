<?php

namespace derekisbusy\contact\models;

use \derekisbusy\contact\models\base\ContactReason as BaseContactReason;

/**
 * This is the model class for table "contact_reason".
 */
class ContactReason extends BaseContactReason
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['reason'], 'string', 'max' => 255]
        ]);
    }
	
}
