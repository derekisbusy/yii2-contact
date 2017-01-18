<?php

namespace derekisbusy\contact\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Contact]].
 *
 * @see Contact
 */
class ContactQuery extends ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Contact[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Contact|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}