<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%books}}`.
 */
class m190301_064217_create_books_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%books}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'date_of_publishing' => $this->dateTime()->notNull(),
            'publisher_id' => $this->integer()->notNull(),
            'rubric_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->createIndex(
            'idx-books-publisher_id',
            '{{%books}}',
            'publisher_id'
        );

        $this->addForeignKey(
            'fk-books-publisher_id',
            '{{%books}}',
            'publisher_id',
            '{{%publishing_house}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-books-rubric_id',
            '{{%books}}',
            'rubric_id'
        );

        $this->addForeignKey(
            'fk-books-rubric_id',
            '{{%books}}',
            'rubric_id',
            '{{%rubrics_tbl}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%books}}');
    }
}
