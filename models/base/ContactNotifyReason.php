<?php

namespace derekisbusy\contact\models\base;

use Yii;

/**
 * This is the base model class for table "{{%contact_notify_reason}}".
 *
 * @property integer $contact_notify_id
 * @property integer $contact_reason_id
 */
class ContactNotifyReason extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contact_notify_id', 'contact_reason_id'], 'required'],
            [['contact_notify_id', 'contact_reason_id'], 'integer']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%contact_notify_reason}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'contact_notify_id' => Yii::t('app', 'Contact Notify ID'),
            'contact_reason_id' => Yii::t('app', 'Contact Reason ID'),
        ];
    }
}
