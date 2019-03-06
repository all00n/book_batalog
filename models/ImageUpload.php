<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ImageUpload extends Model
{

    public $image;

    public function rules()
    {
        return [
            [['image'], 'required'],
            [['image'], 'file','extensions' => 'jpg,png']
        ];
    }

    public function uploadFile(UploadedFile  $file){

        $this->image = $file;

        if ($this->validate()){
            $fileName = $this->generateFileName();

            $file->saveAs( $this->getFolder() . $fileName);

            return $fileName;
        }

    }

    public function dropFile($file){
        if (file_exists($this->getFolder().$file)){
            unlink($this->getFolder().$file);
        }
    }

    private function getFolder(){
        return Yii::getAlias('@web') . 'uploads/';
    }

    private function generateFileName(){
        return md5(uniqid($this->image->baseName)) .'.'.$this->image->extension;
    }

}