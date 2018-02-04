<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[GoodsFile]].
 *
 * @see GoodsFile
 */
class GoodsFileQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return GoodsFile[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return GoodsFile|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
