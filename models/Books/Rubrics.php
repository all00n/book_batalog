<?php

namespace app\models\Books;

use Yii;
use creocoder\nestedsets\NestedSetsBehavior;

/**
 * This is the model class for table "rubrics_tbl".
 *
 * @property int $id
 * @property int $lft
 * @property int $rgt
 * @property int $depth
 * @property string $name
 *
 * @property Books[] $books
 */
class Rubrics extends \yii\db\ActiveRecord
{

    public $sub;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rubrics_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['lft', 'rgt', 'depth','sub'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['lft','rgt','depth'],'safe']
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public function behaviors() {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
            ],
        ];
    }

    public static function find()
    {
        return new RubricsQuery(get_called_class());
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'depth' => 'Depth',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Books::className(), ['rubric_id' => 'id']);
    }

//    public function beforeSave($insert)
//    {
//       if(parent::beforeSave($insert)){
//           if($this->sub == null){
//               $this->makeRoot();
//           } else {
//               $parent = self::find()->andWhere(['id'=>$this->sub])->one();
//               $this->prependTo($parent);
//           }
//           return true;
//       } else {
//           return false;
//       }
//    }
}
