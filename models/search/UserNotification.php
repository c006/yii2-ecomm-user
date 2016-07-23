<?php

namespace c006\user\models\search;

use c006\user\models\UserNotification as UserNotificationModel;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UserNotification represents the model behind the search form about `c006\user\models\UserNotification`.
 */
class UserNotification extends UserNotificationModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'network_id', 'store_id', 'user_id', 'timestamp', 'read'], 'integer'],
            [['message'], 'safe'],
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
        $query = UserNotificationModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        $query->orderBy('timestamp DESC');

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
            'timestamp'  => $this->timestamp,
            'read'       => $this->read,
        ]);

        $query->andFilterWhere(['like', 'message', $this->message]);

        return $dataProvider;
    }
}
