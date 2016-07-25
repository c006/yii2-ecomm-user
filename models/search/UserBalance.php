<?php

namespace c006\user\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use c006\user\models\UserBalance as UserBalanceModel;

/**
 * UserBalance represents the model behind the search form about `c006\user\models\UserBalance`.
 */
class UserBalance extends UserBalanceModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'job_id', 'timestamp'], 'integer'],
            [['hours', 'amount', 'paid'], 'number'],
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
        $query = UserBalanceModel::find();

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
            'id' => $this->id,
            'user_id' => $this->user_id,
            'job_id' => $this->job_id,
            'hours' => $this->hours,
            'amount' => $this->amount,
            'paid' => $this->paid,
            'timestamp' => $this->timestamp,
        ]);

        return $dataProvider;
    }
}
