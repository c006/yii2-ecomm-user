<?php

namespace c006\user\models\search;

use c006\user\models\UserShipping as UserShippingModel;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UserShipping represents the model behind the search form about `c006\user\models\UserShipping`.
 */
class UserShipping extends UserShippingModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'network_id', 'store_id', 'user_id', 'city_id', 'state_id', 'postal_code_id', 'country_id', 'default'], 'integer'],
            [['name', 'address', 'address_apt'], 'safe'],
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
        $query = UserShippingModel::find();

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
            'id'             => $this->id,
            'network_id'     => $this->network_id,
            'store_id'       => $this->store_id,
            'user_id'        => $this->user_id,
            'city_id'        => $this->city_id,
            'state_id'       => $this->state_id,
            'postal_code_id' => $this->postal_code_id,
            'country_id'     => $this->country_id,
            'default'        => $this->default,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'address_apt', $this->address_apt]);

        return $dataProvider;
    }
}
