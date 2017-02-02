<?php

namespace derekisbusy\contact\models\base;

use derekisbusy\contact\models\ContactQuery;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the base model class for table "{{%contact}}".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $assigned_to
 * @property integer $contact_reason_id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $body
 * @property string $url
 * @property string $referrer
 */
class Contact extends ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by', 'assigned_to', 'contact_reason_id'], 'integer'],
            [['contact_reason_id', 'url', 'name', 'phone', 'email'], 'required'],
            [['body', 'url', 'referrer'], 'string'],
            [['name'], 'string', 'max' => 50],
            ['email', 'email'],
            [['phone'], 'string', 'max' => 20]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%contact}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'assigned_to' => Yii::t('app', 'Assigned To'),
            'contact_reason_id' => Yii::t('app', 'Contact Reason'),
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Phone'),
            'body' => Yii::t('app', 'Message'),
            'url' => Yii::t('app', 'Url'),
            'referrer' => Yii::t('app', 'Referrer'),
        ];
    }

/**
     * @inheritdoc
     * @return array mixed
     */ 
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return ContactQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ContactQuery(get_called_class());
    }
}
