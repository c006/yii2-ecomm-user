<?php

namespace c006\user\assets;

use c006\core\assets\CoreHelper;
use c006\user\models\PhoneCarriers;
use c006\user\models\Preferences;
use c006\user\models\User;
use c006\user\models\UserActions;
use c006\user\models\UserBalance;
use c006\user\models\UserBilling;
use c006\user\models\UserFriends;
use c006\user\models\UserFriendsHistory;
use c006\user\models\UserLoans;
use c006\user\models\UserNotification;
use c006\user\models\UserTransaction;
use Yii;

class AppHelper
{

    /**
     * @param bool|TRUE $as_array
     * @param int       $user_id
     * @param int       $network_id
     * @param int       $store_id
     *
     * @return array|null|\yii\db\ActiveRecord|static
     */
    static public function getUser($as_array = TRUE, $user_id = 0, $network_id = 0, $store_id = 0)
    {
        $network_id = ($network_id) ? $network_id : self::getNetwork();
        $store_id   = ($store_id) ? $store_id : self::getStore();
        $user_id    = ($user_id) ? $user_id : Yii::$app->user->id;

        if ($as_array) {
            return User::find()
                ->where(['id' => $user_id])
                ->andWhere(['network_id' => $network_id])
                ->andWhere(['store_id' => $store_id])
                ->asArray()
                ->one();
        } else {
            return User::find()
                ->where(['id' => $user_id])
                ->andWhere(['network_id' => $network_id])
                ->andWhere(['store_id' => $store_id])
                ->one();
        }
    }

    /**
     * @param     $column
     * @param     $value
     * @param int $network_id
     * @param int $store_id
     *
     * @return array|null|\yii\db\ActiveRecord
     */
    static public function getUserBy($column, $value, $network_id = 0, $store_id = 0)
    {
        $network_id = ($network_id) ? $network_id : self::getNetwork();
        $store_id   = ($store_id) ? $store_id : self::getStore();

        return User::find()
            ->where([$column => $value])
            ->andWhere(['network_id' => $network_id])
            ->andWhere(['store_id' => $store_id])
            ->asArray()
            ->one();
    }

    /**
     * @param $phone
     * @param $mac_address
     * @param $security_key
     * @return array|null|\yii\db\ActiveRecord
     */
    static public function getMobileUser($phone, $mac_address = "", $security_key = "")
    {
        $model = User::find()
            ->where(['phone' => $phone]);

        if (strlen($security_key)) {
            $model->andWhere(['phone_security_key' => $security_key]);
        }
        if (strlen($mac_address)) {
            $model->andWhere(['phone_mac_address' => $mac_address]);
        }

        return $model->asArray()->one();
    }

    /**
     * @param int $user_id
     * @param int $network_id
     * @param int $store_id
     * @param     $column
     * @param     $value
     *
     * @return bool
     */
    static public function updateUser($user_id = 0, $network_id = 0, $store_id = 0, $column, $value)
    {
        $model = User::find()
            ->where(['id' => $user_id])
            ->andWhere(['network_id' => $network_id])
            ->andWhere(['store_id' => $store_id])
            ->one();

        $model->$column = $value;

        if ($model->save()) {
            return TRUE;
        }

        if (YII_DEBUG) {
            print_r($model->getErrors());
            exit;
        }

        return FALSE;
    }

    /**
     * @param $user_id
     * @param $user_network_id
     * @param $user_store_id
     *
     * @return array|null|\yii\db\ActiveRecord
     */
    static public function getUserByMd5($user_id, $user_network_id, $user_store_id)
    {
        return User::find()
            ->where(" (MD5(id)) = '" . (substr($user_id, 11, 32)) . "' ")
            ->andWhere(" (MD5(network_id)) = '" . (substr($user_network_id, 11, 32)) . "'")
            ->andWhere(" (MD5(store_id))  = '" . (substr($user_store_id, 11, 32)) . "'")
            ->asArray()
            ->one();
    }

    /**
     * @param $name
     *
     * @return bool|int|mixed
     */
    static public function getCarrierId($name)
    {

        $model = PhoneCarriers::find()
            ->where(['name' => $name])
            ->asArray()
            ->one();

        if (sizeof($model)) {
            return $model['name'];
        }

        $model       = new PhoneCarriers();
        $model->name = ucwords(strtolower($name));

        if ($model->save()) {
            return $model->id;
        }

        if (YII_DEBUG) {
            print_r($model->getErrors());
            exit;
        }

        return FALSE;
    }


    /**
     * @param int $user_id
     * @param int $network_id
     * @param int $store_id
     * @param     $friend_user_id
     * @param int $friend_network_id
     * @param int $friend_store_id
     *
     * @return bool|string
     */
    static public function addFriendRequest($user_id = 0, $network_id = 0, $store_id = 0, $friend_user_id, $friend_network_id = 0, $friend_store_id = 0)
    {

        $user_id    = ($user_id) ? $user_id : Yii::$app->user->id;
        $network_id = ($network_id) ? $network_id : self::getNetwork();
        $store_id   = ($store_id) ? $store_id : self::getStore();

        $friend_network_id = ($friend_network_id) ? $friend_network_id : self::getNetwork();
        $friend_store_id   = ($friend_store_id) ? $friend_store_id : self::getStore();

        if (self::checkFriendRequestExists($user_id, $network_id, $store_id, $friend_user_id, $friend_network_id, $friend_store_id) != FALSE) {
            return FALSE;
        }

        $model                    = new UserFriends();
        $model->user_id           = $user_id;
        $model->network_id        = $network_id;
        $model->store_id          = $store_id;
        $model->friend_id         = $friend_user_id;
        $model->friend_network_id = $friend_network_id;
        $model->friend_store_id   = $friend_store_id;
        $model->confirmed         = 0;
        $model->timestamp         = time();

        if ($model->save()) {
            return $model->id;

        }

        if (YII_DEBUG) {
            print_r($model->getErrors());
            exit;
        }

    }


    /**
     * @param int $user_id
     * @param int $network_id
     * @param int $store_id
     * @param     $friend_user_id
     * @param int $friend_network_id
     * @param int $friend_store_id
     *
     * @return array|bool|null|\yii\db\ActiveRecord
     */
    static public function checkFriendRequestExists($user_id = 0, $network_id = 0, $store_id = 0, $friend_user_id, $friend_network_id = 0, $friend_store_id = 0)
    {
        $model = UserFriends::find()
            ->where(['network_id' => $network_id])
            ->andWhere(['store_id' => $store_id])
            ->andWhere(['user_id' => $user_id])
            ->andWhere(['friend_network_id' => $friend_network_id])
            ->andWhere(['friend_store_id' => $friend_store_id])
            ->andWhere(['friend_id' => $friend_user_id])
            ->asArray()
            ->one();

        return (sizeof($model)) ? $model : FALSE;
    }


    /**
     * @param     $friend_user_id
     * @param int $friend_network_id
     * @param int $friend_store_id
     * @param int $user_id
     * @param int $network_id
     * @param int $store_id
     *
     * @return array|null|\yii\db\ActiveRecord
     */
    static public function getFriend($friend_user_id, $friend_network_id = 0, $friend_store_id = 0, $user_id = 0, $network_id = 0, $store_id = 0)
    {
        $network_id = ($network_id) ? $network_id : self::getNetwork();
        $store_id   = ($store_id) ? $store_id : self::getStore();
        $user_id    = ($user_id) ? $user_id : Yii::$app->user->id;

        $friend_network_id = ($friend_network_id) ? $friend_network_id : self::getNetwork();
        $friend_store_id   = ($friend_store_id) ? $friend_store_id : self::getStore();

        return UserFriends::find()
            ->where(['network_id' => $network_id])
            ->andWhere(['store_id' => $store_id])
            ->andWhere(['user_id' => $user_id])
            ->andWhere(['friend_network_id' => $friend_network_id])
            ->andWhere(['friend_store_id' => $friend_store_id])
            ->andWhere(['friend_id' => $friend_user_id])
            ->asArray()
            ->one();
    }

    /**
     * @param     $user_id
     * @param int $network_id
     * @param int $store_id
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    static public function getFriends($user_id = 0, $network_id = 0, $store_id = 0)
    {
        $network_id = ($network_id) ? $network_id : self::getNetwork();
        $store_id   = ($store_id) ? $store_id : self::getStore();
        $user_id    = ($user_id) ? $user_id : Yii::$app->user->id;

        return UserFriends::find()
            ->where(['network_id' => $network_id])
            ->andWhere(['store_id' => $store_id])
            ->andWhere(['user_id' => $user_id])
            ->asArray()
            ->all();
    }


    /**
     * @param     $user_id
     * @param int $network_id
     * @param int $store_id
     *
     * @return array|null|\yii\db\ActiveRecord
     */
    static public function getFriendRequests($user_id = 0, $network_id = 0, $store_id = 0)
    {

        $user_id    = ($user_id) ? $user_id : Yii::$app->user->id;
        $network_id = ($network_id) ? $network_id : self::getNetwork();
        $store_id   = ($store_id) ? $store_id : self::getStore();

        return UserFriends::find()
            ->where(['network_id' => $network_id])
            ->andWhere(['store_id' => $store_id])
            ->andWhere(['user_id' => $user_id])
            ->andWhere(['confirmed' => 0])
            ->asArray()
            ->all();
    }


    /**
     * @param int $user_id
     * @param int $network_id
     * @param int $store_id
     * @param     $friend_id
     * @param     $friend_network_id
     * @param     $friend_store_id
     *
     * @return array|AppHelper|null|\yii\db\ActiveRecord
     */
    static public function acceptFriend($user_id = 0, $network_id = 0, $store_id = 0, $friend_id, $friend_network_id, $friend_store_id)
    {
        $user_id    = ($user_id) ? $user_id : Yii::$app->user->id;
        $network_id = ($network_id) ? $network_id : self::getNetwork();
        $store_id   = ($store_id) ? $store_id : self::getStore();

        /** @var  $model \c006\user\models\UserFriends */
        $model = UserFriends::find()
            ->where(['network_id' => $network_id])
            ->andWhere(['store_id' => $store_id])
            ->andWhere(['user_id' => $user_id])
            ->andWhere(['friend_network_id' => $friend_network_id])
            ->andWhere(['friend_store_id' => $friend_store_id])
            ->andWhere(['friend_id' => $friend_id])
            ->one();

        if (is_object($model)) {
            $model->confirmed = 1;
            if ($model->save()) {

                return self::getUser(TRUE, $model->friend_id, $model->friend_network_id, $model->friend_store_id);
            }
            if (YII_DEBUG) {
                print_r($model->getErrors());
                exit;
            }
        }

        return [];
    }

    /**
     * @param int $user_id
     * @param int $network_id
     * @param int $store_id
     * @param     $friend_id
     * @param     $friend_network_id
     * @param     $friend_store_id
     *
     * @return bool
     * @throws \Exception
     */
    static public function removeFriend($user_id = 0, $network_id = 0, $store_id = 0, $friend_id, $friend_network_id, $friend_store_id)
    {
        $user_id    = ($user_id) ? $user_id : Yii::$app->user->id;
        $network_id = ($network_id) ? $network_id : self::getNetwork();
        $store_id   = ($store_id) ? $store_id : self::getStore();
        /** @var  $model \c006\user\models\UserFriends */
        $model = UserFriends::find()
            ->where(['network_id' => $network_id])
            ->andWhere(['store_id' => $store_id])
            ->andWhere(['user_id' => $user_id])
            ->andWhere(['friend_network_id' => $friend_network_id])
            ->andWhere(['friend_store_id' => $friend_store_id])
            ->andWhere(['friend_id' => $friend_id])
            ->one();

        if (is_object($model)) {
            $model->delete();

            return TRUE;
        }

        return FALSE;
    }

    /**
     * @param int $user_id
     * @param int $network_id
     * @param int $store_id
     * @param     $friend_id
     * @param     $friend_network_id
     * @param     $friend_store_id
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    static public function getFriendHistory($user_id = 0, $network_id = 0, $store_id = 0, $friend_id, $friend_network_id, $friend_store_id)
    {

        $user_id    = ($user_id) ? $user_id : Yii::$app->user->id;
        $network_id = ($network_id) ? $network_id : self::getNetwork();
        $store_id   = ($store_id) ? $store_id : self::getStore();

        return UserFriendsHistory::find()
            ->joinWith('NotificationType')
            ->where(['network_id' => $network_id])
            ->andWhere(['store_id' => $store_id])
            ->andWhere(['user_id' => $user_id])
            ->andWhere(['friend_network_id' => $friend_network_id])
            ->andWhere(['friend_store_id' => $friend_store_id])
            ->andWhere(['friend_id' => $friend_id])
            ->all();
    }

    /**
     * @param     $message
     * @param     $notification_type_id
     * @param int $user_id
     * @param int $network_id
     * @param int $store_id
     * @param     $friend_id
     * @param     $friend_network_id
     * @param     $friend_store_id
     *
     * @return bool
     */
    static public function addFriendHistory($message, $notification_type_id, $user_id = 0, $network_id = 0, $store_id = 0, $friend_id, $friend_network_id, $friend_store_id)
    {
        $user_id    = ($user_id) ? $user_id : Yii::$app->user->id;
        $network_id = ($network_id) ? $network_id : self::getNetwork();
        $store_id   = ($store_id) ? $store_id : self::getStore();

        $model                       = new UserFriendsHistory();
        $model->user_id              = $user_id;
        $model->network_id           = $network_id;
        $model->store_id             = $store_id;
        $model->friend_id            = $friend_id;
        $model->friend_network_id    = $friend_network_id;
        $model->friend_store_id      = $friend_store_id;
        $model->message              = $message;
        $model->notification_type_id = $notification_type_id;

        if ($model->save()) {
            return TRUE;
        }

        if (YII_DEBUG) {
            print_r($model->getErrors());
            exit;
        }

        return FALSE;

    }

    /**
     * @return int|mixed
     */
    static public function getNetwork()
    {
        $model = Preferences::find()
            ->where(['key' => 'network_id'])
            ->asArray()
            ->one();
        if (sizeof($model)) {
            return $model['value'];
        }

        return 0;
    }

    /**
     * @return int|mixed
     */
    static public function getStore()
    {
        $model = Preferences::find()
            ->where(['key' => 'store_id'])
            ->asArray()
            ->one();
        if (sizeof($model)) {
            return $model['value'];
        }

        return 0;
    }

    /**
     * @param int $user_id
     *
     * @return int|mixed
     */
    static public function getUserBalance($user_id = 0)
    {
        $user_id = ($user_id > 0) ? $user_id : Yii::$app->user->id;
        $model   = UserBalance::find()
            ->where(['user_id' => $user_id])
            ->andWhere(['network_id' => self::getNetwork()])
            ->andWhere(['store_id' => self::getStore()])
            ->asArray()
            ->one();

        if (sizeof($model)) {
            return $model['balance'];
        }

        return 0;
    }

    /**
     * @return string
     */
    static public function createTransactionId()
    {
        $micro_second = microtime(FALSE);
        $micro_second = explode(' ', $micro_second);

        return date('YmjHis') . '-' . str_replace('0.', '', $micro_second[0]) . '-' . CoreHelper::createToken(5);
    }

    /**
     * @param $id
     *
     * @return array|null|\yii\db\ActiveRecord
     */
    static public function getTransactionType($id)
    {
        $id = (is_numeric($id)) ? $id : 0;

        return UserTransaction::find()
            ->where(['id' => $id])
            ->asArray()
            ->one();
    }

    /**
     * @param int $limit
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    static public function getTransactions($limit = 5)
    {
        $model = UserTransaction::find()
            ->joinWith('transactionType')
            ->where(['user_id' => Yii::$app->user->id])
            ->andWhere(['network_id' => self::getNetwork()])
            ->andWhere(['store_id' => self::getStore()])
            ->orderBy('timestamp ASC')
            ->limit($limit)
            ->asArray()
            ->all();

//        print_r($model); exit;

        return $model;
    }

    /**
     * @param $array
     *
     * @return bool
     */
    static public function addTransaction($array)
    {
        $model                      = new UserTransaction();
        $model->network_id          = (isset($array['network_id'])) ? $array['network_id'] : self::getNetwork();
        $model->store_id            = (isset($array['store_id'])) ? $array['store_id'] : self::getStore();
        $model->user_id             = $array['user_id'];
        $model->friend_network_id   = (isset($array['network_id'])) ? $array['network_id'] : 0;
        $model->friend_store_id     = (isset($array['store_id'])) ? $array['store_id'] : 0;
        $model->friend_id           = (isset($array['friend_id'])) ? $array['friend_id'] : 0;
        $model->transaction_type_id = $array['transaction_type_id'];
        $model->amount              = $array['amount'];
        $model->transaction_id      = $array['transaction_id'];
        $model->ledger              = (isset($array['message'])) ? $array['message'] : '';
        $model->timestamp           = time();

        if ($model->validate() && $model->save()) {
            return $model->id;
        }
        /* ~ C006 - Testing Only */
        print_r($model->getErrors());
        exit;

        return $model->getErrors();
    }

    /**
     * @param $id
     */
    static public function voidTransaction($id)
    {
        UserTransaction::deleteAll(['id' => $id]);
    }

    /**
     * @param int $user_id
     * @param int $network_id
     * @param int $store_id
     *
     * @return array|bool
     */
    static public function updateBalance($user_id = 0, $network_id = 0, $store_id = 0)
    {

        $network_id = ($network_id) ? $network_id : self::getNetwork();
        $store_id   = ($store_id) ? $store_id : self::getStore();
        $user_id    = ($user_id) ? $user_id : Yii::$app->user->id;

        $command = Yii::$app->db->createCommand(
            "SELECT sum(amount)
FROM user_transaction
WHERE
network_id = " . $network_id . "
 AND store_id = " . $store_id . "
 AND user_id = " . $user_id . " ");
        $sum     = $command->queryScalar();
        $sum     = (!$sum) ? 0 : $sum;

        /** @var  $model \c006\user\models\UserBalance */
        $model = UserBalance::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->andWhere(['network_id' => self::getNetwork()])
            ->andWhere(['store_id' => self::getStore()])
            ->one();
        if (sizeof($model)) {
            $model->balance = $sum;
        } else {
            $model             = new UserBalance();
            $model->network_id = self::getNetwork();
            $model->store_id   = self::getStore();
            $model->user_id    = Yii::$app->user->id;
            $model->balance    = $sum;
        }

        if ($model->save()) {
            return TRUE;
        }

        return $model->getErrors();
    }


    /**
     * @param     $notification_type_id
     * @param     $message
     * @param int $user_id
     * @param int $network_id
     * @param int $store_id
     *
     * @return array|bool
     */
    static public function addNotification($notification_type_id, $message, $user_id = 0, $network_id = 0, $store_id = 0)
    {
        $network_id = ($network_id) ? $network_id : self::getNetwork();
        $store_id   = ($store_id) ? $store_id : self::getStore();
        $user_id    = ($user_id) ? $user_id : Yii::$app->user->id;

        $model                       = new UserNotification();
        $model->notification_type_id = $notification_type_id;
        $model->network_id           = $network_id;
        $model->store_id             = $store_id;
        $model->user_id              = $user_id;
        $model->message              = $message;
        $model->timestamp            = time();
        $model->read                 = 0;

        if ($model->save()) {
            return $model->id;
        }

        if (YII_DEBUG) {
            print_r($model->getErrors());
            exit;
        }

        return FALSE;
    }

    /**
     * @param        $notification_id
     * @param int    $read
     * @param int    $notification_type_id
     * @param string $message
     *
     * @return bool|string
     */
    static public function updateNotification($notification_id, $read = 0, $notification_type_id = 0, $message = '')
    {

        $model                       = UserNotification::findOne($notification_id);
        $model->notification_type_id = ($notification_type_id) ? $notification_type_id : $model->notification_type_id;
        $model->message              = ($message) ? $message : $model->message;
        $model->timestamp            = time();
        $model->read                 = ($read) ? 1 : 0;

        if ($model->save()) {
            return $model->id;
        }

        if (YII_DEBUG) {
            print_r($model->getErrors());
            exit;
        }

        return FALSE;
    }

    /**
     * @param $notification_id
     * @param $user_id
     *
     * @return int
     */
    static public function removeNotification($notification_id, $user_id)
    {
        $notification_id = (is_numeric($notification_id)) ? $notification_id : 0;
        $user_id         = (is_numeric($user_id)) ? $user_id : 0;

        return UserNotification::deleteAll(" id = " . $notification_id . "' AND user_id = " . $user_id);
    }


    /**
     * @return array|null|\yii\db\ActiveRecord
     */
    static public function getNotifications()
    {
        return UserNotification::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->andWhere(['network_id' => self::getNetwork()])
            ->andWhere(['store_id' => self::getStore()])
            ->asArray()
            ->all();
    }

    /**
     * @param int       $limit
     * @param bool|TRUE $new_only
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    static public function getNotification($limit = 5, $new_only = TRUE)
    {
        $limit = ($limit < 0) ? 100000000 : $limit;

        if ($new_only) {
            $model = UserNotification::find()
                ->joinWith('notificationType')
                ->where(['user_id' => Yii::$app->user->id])
                ->andWhere(['network_id' => self::getNetwork()])
                ->andWhere(['store_id' => self::getStore()])
                ->andWhere(['read' => 0])
                ->orderBy('timestamp DESC')
                ->limit($limit)
                ->asArray()
                ->all();
        } else {
            $model = UserNotification::find()
                ->joinWith('notificationType')
                ->where(['user_id' => Yii::$app->user->id])
                ->andWhere(['network_id' => self::getNetwork()])
                ->andWhere(['store_id' => self::getStore()])
                ->orderBy('timestamp DESC')
                ->limit($limit)
                ->asArray()
                ->all();
        }

        return (sizeof($model)) ? $model : [];
    }


    /**
     * @param $id
     *
     * @return bool
     */
    static public function markReadNotification($id)
    {
        $id          = (is_numeric($id)) ? $id : 0;
        $model       = UserNotification::findOne($id);
        $model->read = 1;

        return $model->save();
    }

    /**
     * @param int $user_id
     * @param int $network_id
     * @param int $store_id
     *
     * @return array|bool|null|\yii\db\ActiveRecord
     */
    static public function getDefaultBilling($user_id = 0, $network_id = 0, $store_id = 0)
    {
        $network_id = ($network_id) ? $network_id : self::getNetwork();
        $store_id   = ($store_id) ? $store_id : self::getStore();
        $user_id    = ($user_id) ? $user_id : Yii::$app->user->id;

        $model = UserBilling::find()
            ->where(['user_id' => $user_id])
            ->andWhere(['network_id' => $network_id])
            ->andWhere(['store_id' => $store_id])
            ->andWhere(['default' => 1])
            ->asArray()
            ->one();

        if (sizeof($model)) {
            return $model;
        }

        return FALSE;
    }

    /**
     * @param        $loan_type_id
     * @param        $amount_asked
     * @param        $amount_fulfilled
     * @param string $message
     * @param        $friend_id
     * @param        $friend_network_id
     * @param        $friend_store_id
     * @param int    $user_id
     * @param int    $network_id
     * @param int    $store_id
     *
     * @return bool
     */
    static public function addLoanRequest($loan_type_id, $amount_asked, $amount_fulfilled, $message = '', $friend_id, $friend_network_id, $friend_store_id, $user_id = 0, $network_id = 0, $store_id = 0)
    {
        $network_id = ($network_id) ? $network_id : self::getNetwork();
        $store_id   = ($store_id) ? $store_id : self::getStore();
        $user_id    = ($user_id) ? $user_id : Yii::$app->user->id;

        $model                    = new UserLoans();
        $model->user_id           = $user_id;
        $model->network_id        = $network_id;
        $model->store_id          = $store_id;
        $model->friend_id         = $friend_id;
        $model->friend_network_id = $friend_network_id;
        $model->friend_store_id   = $friend_store_id;
        $model->confirmed         = 0;
        $model->loan_type_id      = $loan_type_id;
        $model->amount_asked      = $amount_asked;
        $model->amount_fulfilled  = $amount_fulfilled;
        $model->message           = $message;
        $model->timestamp         = time();
        if ($model->save()) {
            return TRUE;
        }

        if (YII_DEBUG) {
            print_r($model->getErrors());
            exit;
        }

        return FALSE;
    }

    /**
     * @param $token
     *
     * @return array|null|\yii\db\ActiveRecord
     */
    static public function getSecureToken($token)
    {
        return UserActions::find()
            ->where(" MD5(security) = '" . md5($token) . "'")
            ->asArray()
            ->one();
    }

    /**
     * @param       $uri
     * @param array $array
     * @param int   $expires
     * @param int   $user_id
     * @param int   $network_id
     * @param int   $store_id
     *
     * @return bool|string
     */
    static public function createSecureToken($uri, $array = [], $expires, $user_id = 0, $network_id = 0, $store_id = 0)
    {

        $network_id = ($network_id) ? $network_id : self::getNetwork();
        $store_id   = ($store_id) ? $store_id : self::getStore();
        $user_id    = ($user_id) ? $user_id : Yii::$app->user->id;

        $token = CoreHelper::createToken(100);
        while (sizeof(self::getSecureToken($token))) {
            $token = CoreHelper::createToken(100);
        }

        $model             = new UserActions();
        $model->security   = $token;
        $model->uri        = $uri;
        $model->array      = (sizeof($array)) ? json_encode($array) : '';
        $model->network_id = $network_id;
        $model->store_id   = $store_id;
        $model->user_id    = $user_id;
        $model->expires    = $expires;

        if ($model->save()) {
            return $token;
        }

        if (YII_DEBUG) {
            print_r($model->getErrors());
            exit;
        }

        return FALSE;
    }

}