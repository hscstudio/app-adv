<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "customer".
 *
 * @property int $user_id
 * @property string $name
 * @property int $gender
 * @property string $born
 * @property string $birthday
 * @property string $avatar
 * @property string $address
 * @property string $phone
 * @property string $id_card
 * @property int $level
 * @property int $point
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property int $status
 */
class Customer extends \yii\db\ActiveRecord
{
    public $avatar_new, $id_card_new;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
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
            [['user_id', 'name'], 'required'],
            [['user_id', 'gender', 'level', 'point', 'created_at', 'updated_at', 'created_by', 'updated_by', 'status'], 'integer'],
            [['birthday'], 'safe'],
            [['address'], 'string'],
            [['name', 'born', 'avatar', 'id_card'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 50],
            [['user_id'], 'unique'],
            [['avatar_new', 'id_card_new'], 'file', 'skipOnEmpty' => true, 
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
            'user_id' => Yii::t('app', 'User ID'),
            'name' => Yii::t('app', 'Name'),
            'gender' => Yii::t('app', 'Gender'),
            'born' => Yii::t('app', 'Born'),
            'birthday' => Yii::t('app', 'Birthday'),
            'avatar' => Yii::t('app', 'Avatar'),
            'avatar_new' => Yii::t('app', 'Avatar'),
            'address' => Yii::t('app', 'Address'),
            'phone' => Yii::t('app', 'Phone'),
            'id_card' => Yii::t('app', 'ID Card'),
            'id_card_new' => Yii::t('app', 'ID Card'),
            'level' => Yii::t('app', 'Level'),
            'point' => Yii::t('app', 'Point'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @inheritdoc
     * @return CustomerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CustomerQuery(get_called_class());
    }

    public function getUser()
    {
        return $this->hasOne(
            User::className(),['id'=>'user_id']
        );
    }
}
