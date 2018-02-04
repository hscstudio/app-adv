<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CustomerShipment]].
 *
 * @see CustomerShipment
 */
class CustomerShipmentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CustomerShipment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CustomerShipment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
