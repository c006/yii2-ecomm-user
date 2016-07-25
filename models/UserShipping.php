<?php

namespace c006\user\models;

use Yii;

/**
 * This is the model class for table "user_shipping".
 *
 * @property string  $id
 * @property integer $network_id
 * @property integer $store_id
 * @property integer $user_id
 * @property string  $name
 * @property string  $address
 * @property string  $address_apt
 * @property integer $city_id
 * @property integer $state_id
 * @property integer $postal_code_id
 * @property integer $country_id
 * @property integer $default
 *
 * @property User    $user
 */
class UserShipping extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_shipping';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['network_id', 'store_id', 'user_id', 'name', 'address', 'city_id', 'state_id', 'postal_code_id', 'country_id'], 'required'],
            [['network_id', 'store_id', 'user_id', 'city_id', 'state_id', 'postal_code_id', 'country_id', 'default'], 'integer'],
            [['name', 'address'], 'string', 'max' => 100],
            [['address_apt'], 'string', 'max' => 45],
            [['user_id'], 'exist', 'skipOnError' => TRUE, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'             => Yii::t('app', 'ID'),
            'network_id'     => Yii::t('app', 'Network ID'),
            'store_id'       => Yii::t('app', 'Store ID'),
            'user_id'        => Yii::t('app', 'User ID'),
            'name'           => Yii::t('app', 'Name'),
            'address'        => Yii::t('app', 'Address'),
            'address_apt'    => Yii::t('app', 'Address Apt'),
            'city_id'        => Yii::t('app', 'City ID'),
            'state_id'       => Yii::t('app', 'State ID'),
            'postal_code_id' => Yii::t('app', 'Postal Code ID'),
            'country_id'     => Yii::t('app', 'Country ID'),
            'default'        => Yii::t('app', 'Default'),
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
