<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%region_tbl}}`.
 */
class m190301_063708_create_region_tbl_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%region_tbl}}', [
            'id' => $this->primaryKey(),
            'region_name' => $this->string()->notNull(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%region_tbl}}');
    }
}
