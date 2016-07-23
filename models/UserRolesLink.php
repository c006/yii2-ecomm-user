<?php

namespace c006\user\models;

use Yii;

/**
 * This is the model class for table "user_roles_link".
 *
 * @property string $user_roles_link_id
 * @property string $user_id
 * @property integer $user_roles_id
 */
class UserRolesLink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_roles_link';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'user_roles_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_roles_link_id' => Yii::t('app', 'User Roles Link ID'),
            'user_id'            => Yii::t('app', 'User ID'),
            'user_roles_id'      => Yii::t('app', 'User Roles ID'),
        ];
    }
}
