<?php

use yii\db\Migration;

/**
 * Handles the creation of table `customer`.
 */
class m180204_043550_create_customer_table extends Migration
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

        $this->createTable('customer', [
            'user_id' => $this->integer()->unique()->notNull(),
            'name' => $this->string(255)->notNull(),
            'gender' => $this->boolean()->notNull()->defaultValue(1),
            'born' => $this->string(255),
            'birthday' => $this->date(),
            'avatar' => $this->string(255),
            'address' => $this->text(),
            'phone' => $this->string(50),
            'id_card' => $this->string(255),
            'level' => $this->smallInteger()->defaultValue(1), // PREMIUM','REGULER'
            'point' => $this->integer()->defaultValue(0),
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
        $this->dropTable('customer');
    }
}
