<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_social_media`.
 */
class m180204_045644_create_user_social_media_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('user_social_media', [
            'user_id' => $this->integer()->unique()->notNull(),
            'facebook_id' => $this->string(),
            'google_id' => $this->string(),
            'twitter_id' => $this->string(),
            'instagram_id' => $this->string(),
            'github_id' => $this->string(),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user_social_media');
    }
}
