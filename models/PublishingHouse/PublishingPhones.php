<?php

namespace app\models\PublishingHouse;

use Yii;

/**
 * This is the model class for table "publishing_phones".
 *
 * @property int $id
 * @property int $phone
 * @property int $publisher_id
 * @property string $created_at
 *
 * @property PublishingHouse $publisher
 */
class PublishingPhones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publishing_phones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone', 'publisher_id'], 'required'],
            [['phone', 'publisher_id'], 'integer'],
            [['created_at'], 'safe'],
            [['publisher_id'], 'exist', 'skipOnError' => true, 'targetClass' => PublishingHouse::className(), 'targetAttribute' => ['publisher_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone' => 'Phone',
            'publisher_id' => 'Publisher ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublisher()
    {
        return $this->hasOne(PublishingHouse::className(), ['id' => 'publisher_id']);
    }
}
