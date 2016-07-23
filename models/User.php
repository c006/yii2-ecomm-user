<?php

namespace c006\user\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer              $id
 * @property integer              $network_id
 * @property integer              $store_id
 * @property string               $username
 * @property string               $auth_key
 * @property string               $password_hash
 * @property string               $password_reset_token
 * @property string               $email
 * @property integer              $role
 * @property integer              $status
 * @property string               $created_at
 * @property string               $updated_at
 * @property string               $phone
 * @property string               $phone_sms
 * @property string               $phone_mms
 * @property integer              $phone_carrier_id
 * @property string               $first_name
 * @property string               $last_name
 * @property string               $pin
 * @property integer              $pin_tries
 * @property integer              $confirmed
 * @property string               $phone_security_key
 * @property string               $phone_mac_address
 *
 * @property PhoneCarriers        $phoneCarrier
 * @property UserActions[]        $userActions
 * @property UserActions[]        $userActions1
 * @property UserBalance[]        $userBalances
 * @property UserBilling[]        $userBillings
 * @property UserFriends[]        $userFriends
 * @property UserFriendsHistory[] $userFriendsHistories
 * @property UserLoans[]          $userLoans
 * @property UserNotification[]   $userNotifications
 * @property UserRating[]         $userRatings
 * @property UserRolesLink[]      $userRolesLinks
 * @property UserShipping[]       $userShippings
 * @property UserTransaction[]    $userTransactions
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE  = 10;
    const ROLE_USER      = 10;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['network_id', 'store_id', 'username', 'auth_key', 'password_hash', 'email', 'first_name', 'last_name'], 'required'],
            [['network_id', 'store_id', 'role', 'status', 'phone_carrier_id', 'pin_tries', 'confirmed'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key', 'pin'], 'string', 'max' => 32],
            [['phone'], 'string', 'max' => 14],
            [['phone_sms', 'phone_mms'], 'string', 'max' => 50],
            [['first_name', 'last_name'], 'string', 'max' => 45],
            [['email'], 'unique'],
            [['phone_carrier_id'], 'exist', 'skipOnError' => TRUE, 'targetClass' => PhoneCarriers::className(), 'targetAttribute' => ['phone_carrier_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                   => Yii::t('app', 'ID'),
            'network_id'           => Yii::t('app', 'Network ID'),
            'store_id'             => Yii::t('app', 'Store ID'),
            'username'             => Yii::t('app', 'Username'),
            'auth_key'             => Yii::t('app', 'Auth Key'),
            'password_hash'        => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email'                => Yii::t('app', 'Email'),
            'role'                 => Yii::t('app', 'Role'),
            'status'               => Yii::t('app', 'Status'),
            'created_at'           => Yii::t('app', 'Created At'),
            'updated_at'           => Yii::t('app', 'Updated At'),
            'phone'                => Yii::t('app', 'Phone'),
            'phone_sms'            => Yii::t('app', 'Phone Sms'),
            'phone_mms'            => Yii::t('app', 'Phone Mms'),
            'phone_carrier_id'     => Yii::t('app', 'Phone Carrier ID'),
            'first_name'           => Yii::t('app', 'First Name'),
            'last_name'            => Yii::t('app', 'Last Name'),
            'pin'                  => Yii::t('app', 'Pin'),
            'pin_tries'            => Yii::t('app', 'Pin Tries'),
            'confirmed'            => Yii::t('app', 'Confirmed'),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = NULL)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * Finds user by email
     *
     * @param string $email
     *
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     *
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     *
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return NULL;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status'               => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     *
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return FALSE;
        }
        $expire    = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts     = explode('_', $token);
        $timestamp = (int)end($parts);

        return $timestamp + $expire >= time();
    }

    /**
     * @return int
     */
    static public function userRoleLevel()
    {
        $model = UserRolesLink::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->andWhere(['>=', 'user_roles_id', 100])
            ->asArray()
            ->one();
        if (is_array($model) && $model['user_roles_id'])
            return $model['user_roles_id'];

        return 0;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     *
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = NULL;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhoneCarrier()
    {
        return $this->hasOne(PhoneCarriers::className(), ['id' => 'phone_carrier_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserBillings()
    {
        return $this->hasMany(UserBilling::className(), ['store_id' => 'store_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserNotifications()
    {
        return $this->hasMany(UserNotification::className(), ['store_id' => 'store_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRolesLinks()
    {
        return $this->hasMany(UserRolesLink::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserShippings()
    {
        return $this->hasMany(UserShipping::className(), ['network_id' => 'network_id']);
    }




}
