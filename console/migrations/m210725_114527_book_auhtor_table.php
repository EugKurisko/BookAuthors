<?php

use yii\db\Migration;

/**
 * Class m210725_114527_book_auhtor_table
 */
class m210725_114527_book_auhtor_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book_author}}',
        [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer(),
            'author_id' => $this->integer()
        ], 'ENGINE=InnoDB');

        $this->createIndex(
            'idx-book_author-book_id',
            'book_author',
            'book_id'
        );

        $this->addForeignKey(
            'fx-book_author-book_id',
        'book_author',
        'book_id',
        'book',
        'id',
        'CASCADE',
        'CASCADE');

        $this->createIndex(
            'idx-book_author-author_id',
            'book_author',
            'author_id'
        );

        $this->addForeignKey(
            'fx-book_author-author_id',
            'book_author',
            'author_id',
            'author',
            'id',
            'CASCADE',
            'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fx-book_author-author_id',
            'book_author'
        );

        $this->dropIndex(
            'idx-book_author-author_id',
            'book_author'
        );

        $this->dropForeignKey(
            'fx-book_author-book_id',
            'book_author'
        );

        $this->dropIndex(
            'idx-book_author-book_id',
            'book_author'
        );

        $this->dropTable('{{%book_author}}');
    }
}
