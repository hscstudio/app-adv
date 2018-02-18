<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[ReservationDetail]].
 *
 * @see ReservationDetail
 */
class ReservationDetailQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ReservationDetail[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ReservationDetail|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
