<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Wallet;

/**
 * WalletSearch represents the model behind the search form about `app\models\Wallet`.
 */
class WalletSearch extends Wallet
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'customer_id', 'order_id'], 'integer'],
            [['deposit', 'withdraw'], 'number'],
            [['narrative','created_at',], 'safe'],
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
        $query = Wallet::find();

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
            'deposit' => $this->deposit,
            'withdraw' => $this->withdraw,
            'customer_id' => $this->customer_id,
            'created_at' => $this->created_at,
        ]);

        $query
            ->andFilterWhere(['like', 'narrative', $this->narrative]);

        return $dataProvider;
    }
}
