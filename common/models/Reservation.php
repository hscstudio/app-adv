<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "reservation".
 *
 * @property int $id
 * @property int $user_id
 * @property string $start
 * @property string $end
 * @property string $warranty
 * @property int $bill
 * @property int $customer_shipment
 * @property string $customer_note
 * @property string $payment_proof
 * @property int $paid_status
 * @property string $admin_note
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property int $status
 */
class Reservation extends \yii\db\ActiveRecord
{
    public $booking_date, $payment_proof_new;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reservation';
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
            [['user_id', 'start', 'end'], 'required'],
            [['user_id', 'bill', 'customer_shipment', 'paid_status', 'created_at', 'updated_at', 'created_by', 'updated_by', 'status'], 'integer'],
            [['start', 'end', 'booking_date'], 'safe'],
            [['warranty', 'admin_note'], 'string'],
            [['customer_note', 'payment_proof'], 'string', 'max' => 255],
            [['payment_proof_new'], 'file', 'skipOnEmpty' => true, 
                'extensions' => 'png, jpg, jpeg, pdf',
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
            'user_id' => Yii::t('app', 'User ID'),
            'start' => Yii::t('app', 'Start'),
            'end' => Yii::t('app', 'End'),
            'booking_date' => Yii::t('app', 'Booking date'),
            'warranty' => Yii::t('app', 'Warranty'),
            'bill' => Yii::t('app', 'Bill'),
            'customer_shipment' => Yii::t('app', 'Customer Shipment'),
            'customer_note' => Yii::t('app', 'Customer Note'),
            'payment_proof' => Yii::t('app', 'Payment Proof'),
            'payment_proof_new' => Yii::t('app', 'Payment Proof'),
            'paid_status' => Yii::t('app', 'Paid Status'),
            'admin_note' => Yii::t('app', 'Admin Note'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @inheritdoc
     * @return ReservationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ReservationQuery(get_called_class());
    }

    public function getCustomer()
    {
        return $this->hasOne(
            Customer::className(),['user_id'=>'user_id']
        );
    }

    public function getShipment()
    {
        return $this->hasOne(
            CustomerShipment::className(),['id'=>'customer_shipment']
        );
    }
}
