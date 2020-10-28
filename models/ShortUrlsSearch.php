<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ShortUrls;

/**
 * ShortUrlsSearch represents the model behind the search form of `app\models\ShortUrls`.
 */
class ShortUrlsSearch extends ShortUrls
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'counter'], 'integer'],
            [['long_url', 'short_code', 'time_create'], 'safe'],
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
        $query = ShortUrls::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'time_create' => $this->time_create,
            'counter' => $this->counter,
        ]);

        $query->andFilterWhere(['like', 'long_url', $this->long_url])
            ->andFilterWhere(['like', 'short_code', $this->short_code]);

        return $dataProvider;
    }
}
