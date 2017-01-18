<?php

namespace derekisbusy\contact\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[ContactReason]].
 *
 * @see ContactReason
 */
class ContactReasonQuery extends ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return ContactReason[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ContactReason|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}