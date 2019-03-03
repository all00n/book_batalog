<?php

use yii\db\Migration;

/**
 * Class m190302_154215_create_view_address
 */
class m190302_154215_create_view_address extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('CREATE  OR REPLACE VIEW `show_address` as
                            SELECT pa.id id, concat(country_name,\' \',region_name,\' \',city_name,\' \',address) address FROM publisher_addresses pa 
                            join country_tbl ct on pa.country_id=ct.id
                            join region_tbl rt on pa.region_id=rt.id
                            join city_tbl cit on pa.city_id=cit.id;');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190302_154215_create_view_address cannot be reverted.\n";
        $this->execute('drop view show_address;');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190302_154215_create_view_address cannot be reverted.\n";

        return false;
    }
    */
}
