<?php

namespace app\models\PublishingHouse;

use Yii;
use app\models\Books\Books;
use app\models\views\ShowAddress;

/**
 * This is the model class for table "publishing_house".
 *
 * @property int $id
 * @property string $publisher_names
 * @property int $address_id
 * @property string $created_at
 *
 * @property Books[] $books
 * @property PublisherAddresses $address
 * @property PublishingPhones[] $publishingPhones
 * @property ShowAddress[] $show_address
 */
class PublishingHouse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publishing_house';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['publisher_names', 'address_id'], 'required'],
            [['address_id'], 'integer'],
            [['created_at'], 'safe'],
            [['publisher_names'], 'string', 'max' => 255],
            [['address_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShowAddress::className(), 'targetAttribute' => ['address_id' => 'id']],
            [['publishing_phones'], 'exist', 'skipOnError' => true, 'targetClass' => PublishingPhones::className(), 'targetAttribute' => ['id' => 'publisher_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'publisher_names' => 'Publisher Names',
            'showAddress' => 'Address',
            'created_at' => 'Created At',
            'listerPhones' => 'Phones'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Books::className(), ['publisher_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShowAddress()
    {
        return $this->hasOne(ShowAddress::className(), ['id' => 'address_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublishing_phones()
    {
        return $this->hasMany(PublishingPhones::className(), ['publisher_id' => 'id']);
    }

    public function getListerPhones()
    {
        $phones = [];
        foreach($this->publishing_phones as $phone) {
            $phones[] = $phone->phone;
        }
        return implode(',', $phones);

    }
}
