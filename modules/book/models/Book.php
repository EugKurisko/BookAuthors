<?php

namespace modules\book\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "{{%book}}".
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string $image
 * @property string|null $publication_date
 *
 * @property BookAuthor[] $bookAuthors
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%book}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'image'], 'required'],
            [['publication_date'], 'safe'],
            [['title'], 'string', 'max' => 64],
            [['description'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 12],
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
            'description' => 'Description',
            'image' => 'Image',
            'publication_date' => 'Publication Date',
        ];
    }

    /**
     * Gets query for [[BookAuthors]].
     *
     * @return ActiveQuery
     */
    public function getBookAuthors()
    {
        return $this->hasMany(BookAuthor::className(), ['book_id' => 'id']);
    }
}
