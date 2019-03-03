<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%photos}}`.
 */
class m190301_064403_create_photos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%photos}}', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer()->notNull(),
            'url' => $this->string()->notNull(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->createIndex(
            'idx-photos-book_id',
            '{{%photos}}',
            'book_id'
        );

        $this->addForeignKey(
            'fk-photos-book_id',
            '{{%photos}}',
            'book_id',
            '{{%books}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%photos}}');
    }
}
