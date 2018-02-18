<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Reservation;

/**
 * ReservationSearch represents the model behind the search form of `common\models\Reservation`.
 */
class ReservationSearch extends Reservation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'bill', 'customer_shipment', 'paid_status', 'created_at', 'updated_at', 'created_by', 'updated_by', 'status'], 'integer'],
            [['start', 'end', 'warranty', 'customer_note', 'payment_proof', 'admin_note'], 'safe'],
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
        $query = Reservation::find();

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
            'user_id' => $this->user_id,
            'start' => $this->start,
            'end' => $this->end,
            'bill' => $this->bill,
            'customer_shipment' => $this->customer_shipment,
            'paid_status' => $this->paid_status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'warranty', $this->warranty])
            ->andFilterWhere(['like', 'customer_note', $this->customer_note])
            ->andFilterWhere(['like', 'payment_proof', $this->payment_proof])
            ->andFilterWhere(['like', 'admin_note', $this->admin_note]);

        return $dataProvider;
    }
}
