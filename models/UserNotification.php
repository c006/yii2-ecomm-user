<?php

namespace c006\user\models;

use Yii;

/**
 * This is the model class for table "user_notification".
 *
 * @property string $id
 * @property integer $notification_type_id
 * @property integer $network_id
 * @property integer $store_id
 * @property integer $user_id
 * @property string $message
 * @property integer $timestamp
 * @property integer $read
 *
 * @property User $network
 * @property User $store
 * @property User $user
 * @property UserNotificationType $notificationType
 */
class UserNotification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_notification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['notification_type_id', 'network_id', 'store_id', 'user_id', 'message', 'timestamp'], 'required'],
            [['notification_type_id', 'network_id', 'store_id', 'user_id', 'timestamp', 'read'], 'integer'],
            [['message'], 'string'],
            [['network_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['network_id' => 'network_id']],
            [['store_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['store_id' => 'store_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['notification_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserNotificationType::className(), 'targetAttribute' => ['notification_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'notification_type_id' => Yii::t('app', 'Notification Type ID'),
            'network_id' => Yii::t('app', 'Network ID'),
            'store_id' => Yii::t('app', 'Store ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'message' => Yii::t('app', 'Message'),
            'timestamp' => Yii::t('app', 'Timestamp'),
            'read' => Yii::t('app', 'Read'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNetwork()
    {
        return $this->hasOne(User::className(), ['network_id' => 'network_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(User::className(), ['store_id' => 'store_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotificationType()
    {
        return $this->hasOne(UserNotificationType::className(), ['id' => 'notification_type_id']);
    }
}
