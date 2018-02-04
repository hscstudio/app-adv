<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[GoodsCategory]].
 *
 * @see GoodsCategory
 */
class GoodsCategoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return GoodsCategory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return GoodsCategory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
