<?php

namespace c006\user\models\search;

use c006\user\models\UserBilling as UserBillingModel;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UserBilling represents the model behind the search form about `c006\user\models\UserBilling`.
 */
class UserBilling extends UserBillingModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'network_id', 'store_id', 'user_id', 'exp_month', 'exp_year', 'default'], 'integer'],
            [['name', 'postal_code'], 'safe'],
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
        $query = UserBillingModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
// uncomment the following line if you do not want to return any records when validation fails
// $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id'         => $this->id,
            'network_id' => $this->network_id,
            'store_id'   => $this->store_id,
            'user_id'    => $this->user_id,
            'exp_month'  => $this->exp_month,
            'exp_year'   => $this->exp_year,
            'default'    => $this->default,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'postal_code', $this->postal_code]);

        return $dataProvider;
    }
}
