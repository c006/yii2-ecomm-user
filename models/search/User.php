<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User as UserModel;

/**
 * User represents the model behind the search form about `common\models\User`.
 */
class User extends UserModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'network_id', 'store_id', 'role', 'status', 'phone_carrier_id', 'pin_tries', 'confirmed'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'created_at', 'updated_at', 'phone', 'phone_sms', 'phone_mms', 'first_name', 'last_name', 'pin'], 'safe'],
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
        $query = UserModel::find();

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
                                   'id'               => $this->id,
                                   'network_id'       => $this->network_id,
                                   'store_id'         => $this->store_id,
                                   'role'             => $this->role,
                                   'status'           => $this->status,
                                   'created_at'       => $this->created_at,
                                   'updated_at'       => $this->updated_at,
                                   'phone_carrier_id' => $this->phone_carrier_id,
                                   'pin_tries'        => $this->pin_tries,
                                   'confirmed'        => $this->confirmed,
                               ]);

        $query->andFilterWhere(['like', 'username', $this->username])
              ->andFilterWhere(['like', 'auth_key', $this->auth_key])
              ->andFilterWhere(['like', 'password_hash', $this->password_hash])
              ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
              ->andFilterWhere(['like', 'email', $this->email])
              ->andFilterWhere(['like', 'phone', $this->phone])
              ->andFilterWhere(['like', 'phone_sms', $this->phone_sms])
              ->andFilterWhere(['like', 'phone_mms', $this->phone_mms])
              ->andFilterWhere(['like', 'first_name', $this->first_name])
              ->andFilterWhere(['like', 'last_name', $this->last_name])
              ->andFilterWhere(['like', 'pin', $this->pin]);

        return $dataProvider;
    }
}
