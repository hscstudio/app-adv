<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "goods_category".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property int $status
 */
class GoodsCategory extends \yii\db\ActiveRecord
{
    public $image_new;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods_category';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['created_at', 'updated_at', 'created_by', 'updated_by', 'status'], 'integer'],
            [['name', 'image'], 'string', 'max' => 255],
            [['image_new'], 'file', 'skipOnEmpty' => true, 
                'extensions' => 'png, jpg, jpeg',
                'maxSize' => 1024*1024*1, // 1 MB
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'image' => Yii::t('app', 'Image'),
            'image_new' => Yii::t('app', 'Image'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @inheritdoc
     * @return GoodsCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GoodsCategoryQuery(get_called_class());
    }
}
