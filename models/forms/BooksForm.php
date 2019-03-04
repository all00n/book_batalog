<?php
/**
 * Created by PhpStorm.
 * User: r8
 * Date: 04.03.19
 * Time: 7:28
 */

namespace app\models\forms;

use app\models\Books\Books;
use app\models\Books\BookAuthor;
use app\models\Books\Photos;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class BooksForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    private $_books;
    private $_photos;
    private $_bookAuthor;

    public function rules()
    {
        return [
            [['url'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['Books'], 'required'],
            [['BookAuthor'], 'required'],
            [['Photos'], 'required'],
        ];
    }

    public function afterValidate()
    {
        $error = false;
        if (!$this->books->validate()) {
            $error = true;
        }
        if (!$this->photos->validate()) {
            $error = true;
        }
        if (!$this->bookAuthor->validate()) {
            $error = true;
        }
        if ($error) {
            $this->addError(null); // add an empty error to prevent saving
        }
        parent::afterValidate();
    }

    public function save()
    {

//        if (!$this->validate()) {
//            return false;
//        }

        $transaction = Yii::$app->db->beginTransaction();

        try{

            $this->books->save();

            $this->bookAuthor->book_id = $this->books->id;

            $this->bookAuthor->save(false);

            if($this->photos->url = UploadedFile::getInstance($this->photos, 'url')) {

                $this->photos->book_id = $this->books->id;

                $this->photos->url = $this->upload($this->books->id);

                //$this->imageFile = null;
                $this->photos->save(false);
            }

            $transaction->commit();
            return true;
        }catch (\Exception $err) {
            $transaction->rollBack();
            return false;
        }
    }

    public function getBooks()
    {
        return $this->_books;
    }

    public function setBooks($books)
    {
        if ($books instanceof Books) {
            $this->_books = $books;
        } else if (is_array($books)) {
            $this->_books->setAttributes($books);
        }
    }

    public function getPhotos()
    {
        if ($this->_photos === null) {
            if ($this->books->isNewRecord) {
                $this->_photos = new Photos();
                $this->_photos->loadDefaultValues();
            } else {
                $this->_photos = $this->books->photos;
            }
        }
        return $this->_photos;
    }

    public function setPhotos($photos)
    {
        if (is_array($photos)) {
            $this->photos->setAttributes($photos);
        } elseif ($photos instanceof Photos) {
            $this->_photos = $photos;
        }
    }

    public function getBookAuthor()
    {
        if ($this->_bookAuthor === null) {
            if ($this->books->isNewRecord) {
                $this->_bookAuthor = new BookAuthor();
                $this->_bookAuthor->loadDefaultValues();
            } else {
                $this->_bookAuthor = $this->books->bookAuthor;
            }
        }
        return $this->_bookAuthor;
    }

    public function setBookAuthor($bookAuthor)
    {
        if (is_array($bookAuthor)) {
            $this->bookAuthor->setAttributes($bookAuthor);
        } elseif ($bookAuthor instanceof BookAuthor) {
            $this->_bookAuthor = $bookAuthor;
        }
    }

    public function upload($book_id)
    {
            $this->photos->url->saveAs('uploads/books_photo/' . $book_id . '.' . $this->photos->url->extension);
            return 'uploads/books_photo/' . $book_id . '.' . $this->photos->url->extension;
    }

    public function errorSummary($form)
    {
        $errorLists = [];
        foreach ($this->getAllModels() as $id => $model) {
            $errorList = $form->errorSummary($model, [
                'header' => '<p>Please fix the following errors for <b>' . $id . '</b></p>',
            ]);
            $errorList = str_replace('<li></li>', '', $errorList); // remove the empty error
            $errorLists[] = $errorList;
        }
        return implode('', $errorLists);
    }

    private function getAllModels()
    {
        return [
            'Books'       => $this->books,
            'Photos'      => $this->photos,
            'Author'      => $this->bookAuthor
        ];
    }

}