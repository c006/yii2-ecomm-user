<?php

namespace c006\user\models\search;

use c006\user\models\UserRoles as UserRolesModel;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UserRoles represents the model behind the search form about `c006\user\models\UserRoles`.
 */
class UserRoles extends UserRolesModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_roles_id', 'level'], 'integer'],
            [['name'], 'safe'],
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
        $query = UserRolesModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'user_roles_id' => $this->user_roles_id,
            'level'         => $this->level,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
