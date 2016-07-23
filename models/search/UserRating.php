<?php

namespace c006\user\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use c006\user\models\UserRating as UserRatingModel;

/**
* UserRating represents the model behind the search form about `c006\user\models\UserRating`.
*/
class UserRating extends UserRatingModel
{
/**
* @inheritdoc
*/
public function rules()
{
return [
[['id', 'network_id', 'store_id', 'user_id', 'active'], 'integer'],
            [['rating'], 'number'],
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
$query = UserRatingModel::find();

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
            'network_id' => $this->network_id,
            'store_id' => $this->store_id,
            'user_id' => $this->user_id,
            'rating' => $this->rating,
            'active' => $this->active,
        ]);

return $dataProvider;
}
}
