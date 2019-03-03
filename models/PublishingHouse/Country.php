<?php

namespace app\models\PublishingHouse;

use Yii;

/**
 * This is the model class for table "country_tbl".
 *
 * @property int $id
 * @property string $country_name
 * @property string $created_at
 *
 * @property PublisherAddresses[] $publisherAddresses
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'country_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country_name'], 'required'],
            [['country_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'country_name' => 'Country Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublisherAddresses()
    {
        return $this->hasMany(PublisherAddresses::className(), ['country_id' => 'id']);
    }
}
