<?php

namespace c006\user\models;

use Yii;

/**
 * This is the model class for table "user_balance".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $job_id
 * @property string $hours
 * @property string $amount
 * @property string $paid
 * @property integer $timestamp
 *
 * @property User $user
 */
class UserBalance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_balance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'job_id', 'timestamp'], 'required'],
            [['user_id', 'job_id', 'timestamp'], 'integer'],
            [['hours', 'amount', 'paid'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'job_id' => Yii::t('app', 'Job ID'),
            'hours' => Yii::t('app', 'Hours'),
            'amount' => Yii::t('app', 'Amount'),
            'paid' => Yii::t('app', 'Paid'),
            'timestamp' => Yii::t('app', 'Timestamp'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
