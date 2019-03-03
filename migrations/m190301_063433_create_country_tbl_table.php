<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%country_tbl}}`.
 */
class m190301_063433_create_country_tbl_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%country_tbl}}', [
            'id' => $this->primaryKey(),
            'country_name' => $this->string()->notNull(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%country_tbl}}');
    }
}
