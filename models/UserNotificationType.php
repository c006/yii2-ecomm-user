<?php

namespace c006\user\models;

use Yii;

/**
 * This is the model class for table "user_notification_type".
 *
 * @property integer            $id
 * @property string             $name
 * @property string             $css
 *
 * @property UserNotification[] $userNotifications
 */
class UserNotificationType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_notification_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['css'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'   => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'css'  => Yii::t('app', 'Css'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserNotifications()
    {
        return $this->hasMany(UserNotification::className(), ['notification_type_id' => 'id']);
    }
}
