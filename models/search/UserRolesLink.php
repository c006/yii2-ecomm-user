<?php

namespace c006\user\models\search;

use c006\user\models\UserRolesLink as UserRolesLinkModel;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UserRolesLink represents the model behind the search form about `c006\user\models\UserRolesLink`.
 */
class UserRolesLink extends UserRolesLinkModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_roles_link_id', 'user_id', 'user_roles_id'], 'integer'],
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
        $query = UserRolesLinkModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'user_roles_link_id' => $this->user_roles_link_id,
            'user_id'            => $this->user_id,
            'user_roles_id'      => $this->user_roles_id,
        ]);

        return $dataProvider;
    }
}
