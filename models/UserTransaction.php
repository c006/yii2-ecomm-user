<?php

namespace c006\user\models;

use Yii;

/**
 * This is the model class for table "user_transaction".
 *
 * @property string  $id
 * @property integer $network_id
 * @property integer $store_id
 * @property integer $user_id
 * @property integer $transaction_type_id
 * @property string  $amount
 * @property string  $transaction_id
 * @property string  $auth
 * @property integer $timestamp
 *
 * @property User    $user
 */
class UserTransaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['network_id', 'store_id', 'user_id', 'transaction_type_id', 'amount', 'transaction_id', 'timestamp'], 'required'],
            [['network_id', 'store_id', 'user_id', 'transaction_type_id', 'timestamp'], 'integer'],
            [['amount'], 'number'],
            [['transaction_id'], 'string', 'max' => 30],
            [['auth'], 'string', 'max' => 200],
            [['user_id'], 'exist', 'skipOnError' => TRUE, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                  => Yii::t('app', 'ID'),
            'network_id'          => Yii::t('app', 'Network ID'),
            'store_id'            => Yii::t('app', 'Store ID'),
            'user_id'             => Yii::t('app', 'User ID'),
            'transaction_type_id' => Yii::t('app', 'Transaction Type ID'),
            'amount'              => Yii::t('app', 'Amount'),
            'transaction_id'      => Yii::t('app', 'Transaction ID'),
            'auth'              => Yii::t('app', 'Auth'),
            'timestamp'           => Yii::t('app', 'Timestamp'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }


    public function getTransactionType()
    {
        return $this->hasOne(UserTransactionType::className(), ['id' => 'transaction_type_id']);
    }
}
