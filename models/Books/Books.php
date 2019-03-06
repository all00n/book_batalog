<?php

namespace app\models\Books;

use Yii;
use app\models\PublishingHouse\PublishingHouse;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string $title
 * @property string $date_of_publishing
 * @property int $publisher_id
 * @property int $rubric_id
 * @property string $created_at
 *
 * @property BookAuthor[] $bookAuthor
 * @property PublishingHouse $publisher
 * @property Rubrics $rubric
 * @property Photos[] $photos
 */
class Books extends \yii\db\ActiveRecord
{
    public $index;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'date_of_publishing', 'publisher_id', 'rubric_id'], 'required'],
            [['date_of_publishing', 'created_at','index'], 'safe'],
            [['publisher_id', 'rubric_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['publisher_id'], 'exist', 'skipOnError' => true, 'targetClass' => PublishingHouse::className(), 'targetAttribute' => ['publisher_id' => 'id']],
            [['rubric_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rubrics::className(), 'targetAttribute' => ['rubric_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'date_of_publishing' => 'Date Of Publishing',
            'publisher_id' => 'Publisher ID',
            'rubric_id' => 'Rubric ID',
            'created_at' => 'Created At',
            'Photos' => 'Photo'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookAuthor()
    {
        return $this->hasMany(BookAuthor::className(), ['book_id' => 'id']);
    }

    public function getAuthors()
    {
        return $this->hasMany(Authors::className(),['id' => 'author_id'])
            ->viaTable('book_author',['book_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublisher()
    {
        return $this->hasOne(PublishingHouse::className(), ['id' => 'publisher_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRubric()
    {
        return $this->hasOne(Rubrics::className(), ['id' => 'rubric_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotos()
    {
        return $this->hasMany(Photos::className(), ['book_id' => 'id']);
    }
}
