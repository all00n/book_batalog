<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%publishing_phones}}`.
 */
class m190301_064024_create_publishing_phones_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%publishing_phones}}', [
            'id' => $this->primaryKey(),
            'phone' => $this->integer(13)->notNull()->unsigned(),
            'publisher_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->createIndex(
            'idx-publishing_phones-publisher_id',
            '{{%publishing_phones}}',
            'publisher_id'
        );

        $this->addForeignKey(
            'fk-publishing_phones-publisher_id',
            '{{%publishing_phones}}',
            'publisher_id',
            '{{%publishing_house}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%publishing_phones}}');
    }
}
