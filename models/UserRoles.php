<?php

namespace c006\user\models;

use Yii;

/**
 * This is the model class for table "user_roles".
 *
 * @property integer $user_roles_id
 * @property string $name
 * @property integer $level
 */
class UserRoles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_roles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['user_roles_id', 'level'], 'integer'],
            [['name'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_roles_id' => Yii::t('app', 'User Roles ID'),
            'name'          => Yii::t('app', 'Name'),
            'level'         => Yii::t('app', 'Level'),
        ];
    }
}
