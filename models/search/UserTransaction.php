<?php

namespace c006\user\models\search;

use c006\user\assets\AppHelper;
use c006\user\models\UserTransaction as UserTransactionModel;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UserTransaction represents the model behind the search form about `c006\user\models\UserTransaction`.
 */
class UserTransaction extends UserTransactionModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'network_id', 'store_id', 'user_id', 'transaction_type_id', 'timestamp'], 'integer'],
            [['amount'], 'number'],
            [['transaction_id'], 'safe'],
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
        $query = UserTransactionModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $query
            ->where(['user_id' => Yii::$app->user->id])
            ->andWhere(['network_id' => AppHelper::getNetwork()])
            ->andWhere(['store_id' => AppHelper::getStore()]);

        if (!$this->validate()) {
// uncomment the following line if you do not want to return any records when validation fails
// $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id'                  => $this->id,
            'network_id'          => $this->network_id,
            'store_id'            => $this->store_id,
            'user_id'             => $this->user_id,
            'transaction_type_id' => $this->transaction_type_id,
            'amount'              => $this->amount,
            'timestamp'           => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'transaction_id', $this->transaction_id]);

        return $dataProvider;
    }
}
