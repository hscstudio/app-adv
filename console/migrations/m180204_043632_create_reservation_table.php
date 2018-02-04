<?php

use yii\db\Migration;

/**
 * Handles the creation of table `reservation`.
 */
class m180204_043632_create_reservation_table extends Migration
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
  
        $this->createTable('reservation', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->unique()->notNull(),
            'start' => $this->dateTime()->notNull(),
            'end' => $this->dateTime()->notNull(),
            'warranty' => $this->text(),
            'bill' => $this->integer(),
            'customer_shipment' => $this->integer()->notNull()->defaultValue(0),
            'customer_note' => $this->string(255),
            'payment_proof' => $this->string(255),
            'paid_status' => $this->smallInteger()->notNull()->defaultValue(0),
            'admin_note' => $this->text(),
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
        $this->dropTable('reservation');
    }
}
