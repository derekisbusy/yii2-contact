<?php

namespace derekisbusy\contact\models\base;

use derekisbusy\contact\models\base\ContactNotifyReason;
use derekisbusy\contact\models\ContactNotifyQuery;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the base model class for table "{{%contact_notify}}".
 *
 * @property integer $id
 * @property string $email
 */
class ContactNotify extends ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['email'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%contact_notify}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'Email'),
        ];
    }

    /**
     * @inheritdoc
     * @return ContactNotifyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ContactNotifyQuery(get_called_class());
    }
    
    public function beforeDelete()
    {
        if(!parent::beforeDelete()) {
            return false;
        }
        
        // delete related values in junction table.
        ContactNotifyReason::deleteAll('contact_notify_id = :nid', [':nid' => $this->id]);
        return true;
    }
}
