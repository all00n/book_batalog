<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%city_tbl}}`.
 */
class m190301_063740_create_city_tbl_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%city_tbl}}', [
            'id' => $this->primaryKey(),
            'city_name' => $this->string()->notNull(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%city_tbl}}');
    }
}
