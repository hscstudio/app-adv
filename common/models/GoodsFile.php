<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "goods_file".
 *
 * @property int $id
 * @property int $goods_id
 * @property string $title
 * @property string $description
 * @property string $file
 * @property int $type
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property int $status
 */
class GoodsFile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods_file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id', 'title'], 'required'],
            [['goods_id', 'type', 'created_at', 'updated_at', 'created_by', 'updated_by', 'status'], 'integer'],
            [['description'], 'string'],
            [['title', 'file'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'goods_id' => Yii::t('app', 'Goods ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'file' => Yii::t('app', 'File'),
            'type' => Yii::t('app', 'Type'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @inheritdoc
     * @return GoodsFileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GoodsFileQuery(get_called_class());
    }
}
