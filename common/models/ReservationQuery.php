<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Reservation]].
 *
 * @see Reservation
 */
class ReservationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Reservation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Reservation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
