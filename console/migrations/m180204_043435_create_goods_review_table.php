<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_review`.
 */
class m180204_043435_create_goods_review_table extends Migration
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

        $this->createTable('goods_review', [
            'id' => $this->primaryKey(),
            'goods_id' => $this->integer()->notNull(),  
            'user_id' => $this->integer()->notNull(),  
            'review' => $this->text()->notNull(),
            'response_admin' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'status' => $this->boolean()->notNull()->defaultValue(1),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods_review');
    }
}
