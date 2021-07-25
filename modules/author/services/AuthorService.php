<?php

namespace modules\author\services;

use modules\author\models\Author;
use Throwable;
use Yii;
use yii\base\Model;

class AuthorService extends Model
{
    /** @var Author  */
    private $author;

    public function __construct(Author $author, array $config = [])
    {
        parent::__construct($config);
        $this->author = $author;
    }

    public function load($data, $formName = null):bool
    {
        parent::load($data, $formName);
        $this->author->load($data);
        return true;
    }

    public function save(): bool
    {
        $trans = Yii::$app->db->beginTransaction();

        try {
            $this->author->save();
            $trans->commit();
            return true;
        }  catch (Throwable $thr) {
            $trans->rollBack();
            Yii::error('Error: ' . $thr->getMessage() . '; File: '
                . $thr->getFile() . '; Line: ' . $thr->getLine(), 'BookService');
            return false;
        }
    }
}