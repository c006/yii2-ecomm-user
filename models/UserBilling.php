<?php

namespace c006\user\models;

use Yii;

/**
 * This is the model class for table "user_billing".
 *
 * @property string  $id
 * @property integer $network_id
 * @property integer $store_id
 * @property integer $user_id
 * @property string  $name
 * @property integer $exp_month
 * @property integer $exp_year
 * @property string  $postal_code
 * @property integer $default
 *
 * @property User    $user
 */
class UserBilling extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_billing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['network_id', 'store_id', 'user_id', 'name', 'exp_month', 'exp_year', 'postal_code'], 'required'],
            [['network_id', 'store_id', 'user_id', 'exp_month', 'exp_year', 'default'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['postal_code'], 'string', 'max' => 18],
            [['user_id'], 'exist', 'skipOnError' => TRUE, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => Yii::t('app', 'ID'),
            'network_id'  => Yii::t('app', 'Network ID'),
            'store_id'    => Yii::t('app', 'Store ID'),
            'user_id'     => Yii::t('app', 'User ID'),
            'name'        => Yii::t('app', 'Name'),
            'exp_month'   => Yii::t('app', 'Exp Month'),
            'exp_year'    => Yii::t('app', 'Exp Year'),
            'postal_code' => Yii::t('app', 'Postal Code'),
            'default'     => Yii::t('app', 'Default'),
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
