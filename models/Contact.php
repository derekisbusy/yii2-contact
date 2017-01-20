<?php

namespace derekisbusy\contact\models;

use derekisbusy\contact\models\base\Contact as BaseContact;
use derekisbusy\contact\models\base\ContactReason;
use yii\db\ActiveQuery;
use derekisbusy\contact\backend\modules\contact\Module;

/**
 * This is the model class for table "contact".
 */
class Contact extends BaseContact
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by', 'assigned_to', 'contact_reason_id'], 'integer'],
            [['contact_reason_id', 'url'], 'required'],
            [['body', 'url', 'referrer'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 20]
        ]);
    }
    
    /**
     * @return ActiveQuery
     */
    public function getAssignedTo()
    {
        return $this->hasOne(Module::getUserClassname(), [Module::getUserModelIdName() => 'assigned_to']);
    }
    
    /**
     * @return ActiveQuery
     */
    public function getReason()
    {
        return $this->hasOne(ContactReason::className(), ['id' => 'contact_reason_id']);
    }

}
