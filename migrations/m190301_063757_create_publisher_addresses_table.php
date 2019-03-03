<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%publisher_addresses}}`.
 */
class m190301_063757_create_publisher_addresses_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%publisher_addresses}}', [
            'id' => $this->primaryKey(),
            'country_id' => $this->integer()->notNull(),
            'region_id' => $this->integer()->notNull(),
            'city_id' => $this->integer()->notNull(),
            'address' => $this->string()->notNull(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->createIndex(
            'idx-publisher_addresses-country_id',
            'publisher_addresses',
            'country_id'
        );
        $this->addForeignKey(
            'fk-publisher_addresses-country_id',
            'publisher_addresses',
            'country_id',
            'country_tbl',
            'id',
            'CASCADE'
        );


        $this->createIndex(
            'idx-publisher_addresses-region_id',
            'publisher_addresses',
            'region_id'
        );
        $this->addForeignKey(
            'fk-publisher_addresses-region_id',
            'publisher_addresses',
            'region_id',
            'region_tbl',
            'id',
            'CASCADE'
        );


        $this->createIndex(
            'idx-publisher_addresses-city_id',
            'publisher_addresses',
            'city_id'
        );
        $this->addForeignKey(
            'fk-publisher_addresses-city_id',
            'publisher_addresses',
            'city_id',
            'city_tbl',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%publisher_addresses}}');
    }
}
