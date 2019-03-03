<?php

namespace app\models\PublishingHouse;

use Yii;

/**
 * This is the model class for table "region_tbl".
 *
 * @property int $id
 * @property string $region_name
 * @property string $created_at
 *
 * @property PublisherAddresses[] $publisherAddresses
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'region_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['region_name'], 'required'],
            [['created_at'], 'safe'],
            [['region_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'region_name' => 'Region Name',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublisherAddresses()
    {
        return $this->hasMany(PublisherAddresses::className(), ['region_id' => 'id']);
    }
}
