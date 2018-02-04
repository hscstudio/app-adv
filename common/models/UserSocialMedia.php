<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_social_media".
 *
 * @property int $user_id
 * @property string $facebook_id
 * @property string $google_id
 * @property string $twitter_id
 * @property string $instagram_id
 * @property string $github_id
 */
class UserSocialMedia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_social_media';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['facebook_id', 'google_id', 'twitter_id', 'instagram_id', 'github_id'], 'string', 'max' => 255],
            [['user_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'facebook_id' => Yii::t('app', 'Facebook ID'),
            'google_id' => Yii::t('app', 'Google ID'),
            'twitter_id' => Yii::t('app', 'Twitter ID'),
            'instagram_id' => Yii::t('app', 'Instagram ID'),
            'github_id' => Yii::t('app', 'Github ID'),
        ];
    }

    /**
     * @inheritdoc
     * @return UserSocialMediaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserSocialMediaQuery(get_called_class());
    }
}
