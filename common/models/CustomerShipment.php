<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "customer_shipment".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property int $status
 */
class CustomerShipment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_shipment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'name'], 'required'],
            [['user_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'status'], 'integer'],
            [['address'], 'string'],
            [['title', 'name'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 50],
            [['user_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'title' => Yii::t('app', 'Title'),
            'name' => Yii::t('app', 'Name'),
            'address' => Yii::t('app', 'Address'),
            'phone' => Yii::t('app', 'Phone'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @inheritdoc
     * @return CustomerShipmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CustomerShipmentQuery(get_called_class());
    }
}
