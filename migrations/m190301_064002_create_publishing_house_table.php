<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%publishing_house}}`.
 */
class m190301_064002_create_publishing_house_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%publishing_house}}', [
            'id' => $this->primaryKey(),
            'publisher_names' => $this->string()->notNull(),
            'phones' => $this->string(),
            'address_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->createIndex(
            'idx-publishing_house-address_id',
            'publishing_house',
            'address_id'
        );

        $this->addForeignKey(
            'fk-publishing_house-address_id',
            'publishing_house',
            'address_id',
            'publisher_addresses',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%publishing_house}}');
    }
}
