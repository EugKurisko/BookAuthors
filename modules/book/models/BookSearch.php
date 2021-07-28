<?php

namespace modules\book\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use modules\book\models\Book;

/**
 * BookSearch represents the model behind the search form of `modules\book\models\Book`.
 */
class BookSearch extends Book
{
    public $name;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'description', 'image', 'publication_date', 'name'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {

        $query = Book::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'title',
                'name' => [
                    'asc' => ['name' => SORT_ASC],
                    'desc' => ['name' => SORT_DESC],
                    'label' => 'Author name'
                ],
            ]
        ]);

//        if(!($this->load($params) && $this->validate())){
//
//        }

        $query->joinWith([
           'bookAuthors.author' => function ($q)
           {
               $q->andWhere('author.first_name LIKE "%' . $this->name . '%"');
           }
        ]);

        return $dataProvider;
    }
}
