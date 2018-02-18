<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "reservation_detail".
 *
 * @property int $reservation_id
 * @property int $goods_id
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property int $status
 */
class ReservationDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reservation_detail';
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
            [['reservation_id', 'goods_id'], 'required'],
            [['reservation_id', 'goods_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'reservation_id' => Yii::t('app', 'Reservation ID'),
            'goods_id' => Yii::t('app', 'Goods ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @inheritdoc
     * @return ReservationDetailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ReservationDetailQuery(get_called_class());
    }

    public function getGoods()
    {
        return $this->hasOne(
            Goods::className(),['id'=>'goods_id']
        );
    }
}
