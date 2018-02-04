<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "goods_comment".
 *
 * @property int $id
 * @property int $reply_id
 * @property int $goods_id
 * @property int $user_id
 * @property string $review
 * @property string $response_admin
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property int $status
 */
class GoodsComment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reply_id', 'goods_id', 'user_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'status'], 'integer'],
            [['goods_id', 'user_id', 'review'], 'required'],
            [['review', 'response_admin'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'reply_id' => Yii::t('app', 'Reply ID'),
            'goods_id' => Yii::t('app', 'Goods ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'review' => Yii::t('app', 'Review'),
            'response_admin' => Yii::t('app', 'Response Admin'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @inheritdoc
     * @return GoodsCommentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GoodsCommentQuery(get_called_class());
    }
}
