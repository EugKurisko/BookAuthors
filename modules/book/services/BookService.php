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
//        dd($this->book);
//        dd($data);
        $authorIds = ArrayHelper::getValue($data[$this->book->formName()], 'bookAuthors') ?: [];
//        dd($authorIds);
        $this->bookAuthors = [];
        foreach ($authorIds as $authorId)
        {
            $model = new BookAuthor();
            $model->author_id = $authorId;
//            dd(UploadedFile::getInstance($this->book, 'image'));
//            dd($this->book);

//            dd($this->book->imageFile);
            $this->bookAuthors[] = $model;
        }
        $this->book->imageFile = UploadedFile::getInstance($this->book, 'image');
//        dd($this->book);
//        dd($this->bookAuthors);
        return true;
    }

    public function save(): bool
    {
        $trans = Yii::$app->db->beginTransaction();

        try
        {
//            dd(1);
//            dd($this->book);
//            dd($this->book->imageFile['name']);
            $this->book->image = '46';//$this->book->imageFile->name;
//dd(1);
            if(!$this->book->save())
            {
                $trans->rollBack();
                return false;
            }

            ImageUpload::upload($this->book, 'book');
//            dd(1);
            BookAuthor::deleteAll(['book_id' => $this->book->id]);//if we updating record
            foreach ($this->bookAuthors as $bookAuthor)
            {

                $bookAuthor->book_id = $this->book->id;
//                dd($bookAuthor);
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