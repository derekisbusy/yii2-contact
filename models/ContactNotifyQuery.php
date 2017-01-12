<?php

namespace derekisbusy\contact\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[ContactNotify]].
 *
 * @see ContactNotify
 */
class ContactNotifyQuery extends ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return ContactNotify[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ContactNotify|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}