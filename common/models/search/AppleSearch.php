<?php

namespace common\models\search;

use common\models\Apple;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * AppleSearch represents the model behind the search form of `common\models\Apple`.
 */
class AppleSearch extends Model
{
    public $id;
    public $color;
    public $created_date;
    public $fallen_date;
    public $status;
    public $remained;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_date', 'fallen_date'], 'integer'],
            [['color', 'status'], 'safe'],
            [['remained'], 'number'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Apple::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
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
            'created_date' => $this->created_date,
            'fallen_date' => $this->fallen_date,
            'remained' => $this->remained,
        ]);

        $query->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
