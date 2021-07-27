<?php

namespace modules\book\services;

use backend\models\ImageUpload;
use modules\book\models\Book;
use modules\book\models\BookAuthor;
use Throwable;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

class BookService extends Model
{
    /** @var Book  */
    private Book $book;

    /** @var BookAuthor[] */
    private $bookAuthors;

    public function __construct(Book $book, array $config = [])
    {
        parent::__construct($config);
        $this->book = $book;
    }

    public function load($data, $formName = null):bool
    {
        parent::load($data, $formName);
        $this->book->load($data);
        $authorIds = ArrayHelper::getValue($data[$this->book->formName()], 'bookAuthors') ?: [];
        $this->bookAuthors = [];
        foreach ($authorIds as $authorId)
        {
            $model = new BookAuthor();
            $model->author_id = $authorId;
            $this->bookAuthors[] = $model;
        }
        $this->book->imageFile = UploadedFile::getInstance($this->book, 'image');
        return true;
    }

    public function save(): bool
    {
        $trans = Yii::$app->db->beginTransaction();

        try
        {
            $this->book->image = $this->book->imageFile->name;
            if(!$this->book->save())
            {
                $trans->rollBack();
                return false;
            }
            ImageUpload::upload($this->book, 'book');
            BookAuthor::deleteAll(['book_id' => $this->book->id]);//if we updating record
            foreach ($this->bookAuthors as $bookAuthor)
            {
                $bookAuthor->book_id = $this->book->id;
                if(!$bookAuthor->save())
                {
                    $trans->rollBack();
                    return false;
                }

            }
            $trans->commit();
            return true;
        }
        catch (Throwable $thr) {
            $trans->rollBack();
            Yii::error('Error: ' . $thr->getMessage() . '; File: '
                . $thr->getFile() . '; Line: ' . $thr->getLine(), 'BookService');
            return false;
        }
    }
}