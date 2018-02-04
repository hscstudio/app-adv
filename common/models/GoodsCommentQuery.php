<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[GoodsComment]].
 *
 * @see GoodsComment
 */
class GoodsCommentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return GoodsComment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return GoodsComment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
