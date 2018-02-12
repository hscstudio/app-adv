<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\GoodsComment;

/**
 * GoodsCommentSearch represents the model behind the search form of `common\models\GoodsComment`.
 */
class GoodsCommentSearch extends GoodsComment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'reply_id', 'goods_id', 'user_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'status'], 'integer'],
            [['review', 'response_admin'], 'safe'],
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
        $query = GoodsComment::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'reply_id' => $this->reply_id,
            'goods_id' => $this->goods_id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'review', $this->review])
            ->andFilterWhere(['like', 'response_admin', $this->response_admin]);

        return $dataProvider;
    }
}
