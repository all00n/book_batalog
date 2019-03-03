<?php

namespace app\models\PublishingHouse;

use Yii;

/**
 * This is the model class for table "publisher_addresses".
 *
 * @property int $id
 * @property int $country_id
 * @property int $region_id
 * @property int $city_id
 * @property string $address
 * @property string $created_at
 *
 * @property City $city
 * @property Country $country
 * @property Region $region
 * @property PublishingHouse[] $publishingHouses
 */
class PublisherAddresses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publisher_addresses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country_id', 'region_id', 'city_id', 'address'], 'required'],
            [['country_id', 'region_id', 'city_id'], 'integer'],
            [['created_at'], 'safe'],
            [['address'], 'string', 'max' => 255],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country_id' => 'Country ID',
            'region_id' => 'Region ID',
            'city_id' => 'City ID',
            'address' => 'Address',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublishingHouses()
    {
        return $this->hasMany(PublishingHouse::className(), ['address_id' => 'id']);
    }
}
