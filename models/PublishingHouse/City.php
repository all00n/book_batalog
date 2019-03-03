<?php

namespace app\models\PublishingHouse;

use Yii;

/**
 * This is the model class for table "city_tbl".
 *
 * @property int $id
 * @property string $city_name
 * @property string $created_at
 *
 * @property PublisherAddresses[] $publisherAddresses
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_name'], 'required'],
            [['created_at'], 'safe'],
            [['city_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city_name' => 'City Name',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublisherAddresses()
    {
        return $this->hasMany(PublisherAddresses::className(), ['city_id' => 'id']);
    }
}
