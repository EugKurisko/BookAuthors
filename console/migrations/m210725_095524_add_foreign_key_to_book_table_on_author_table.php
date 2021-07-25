<?php

use yii\db\Migration;

/**
 * Class m210725_095524_add_foreign_key_to_book_table_on_author_table
 */
class m210725_095524_add_foreign_key_to_book_table_on_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            'book',
            'author_id',
            $this->integer()->notNull()
        );

        $this->createIndex(
            'idx-book-author_id',
        'book',
        'author_id');

        $this->addForeignKey(
            'fk-book-author_id',
            'book',
            'author_id',
            'author',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-book-author_id',
            'book'
        );

        $this->dropIndex(
            'idx-book-author_id',
            'book'
        );

        $this->dropColumn(
            'book',
            'author_id'
        );
    }
}
